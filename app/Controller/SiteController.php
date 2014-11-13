<?php

class SiteController extends AppController {

	public function index() {
		$this->disableCache();
		$hrefsFromDb = $this->requestAction('/items/getHrefList');
		
		$arrayRes = array();
		$linksFromAllPages = array();
		$allLinks = array();
		$resultLinks = array();
		$results = array();

		$currentSite = Configure::read('currentSite');
		
		$homeUrl = $currentSite['homeUrl'];
		$nextPage = $currentSite['nextPage'];
		$keywords = $currentSite['keywords'];

		// регулярки
		$regularForAllItems = $currentSite['regularForAllItems'];
		$regularForTitle = $currentSite['regularForTitle'];
		$regularForOnePageSmallerPice = $currentSite['regularForOnePageSmallerPice'];
		$regularForPrice = $currentSite['regularForPrice'];
		$regularForDescription = $currentSite['regularForDescription'];
		$regularForImages = $currentSite['regularForImages'];
		$regularForPhone = $currentSite['regularForPhone'];
		$regularForEmail = $currentSite['regularForEmail'];
		$regularForAuthor = $currentSite['regularForAuthor'];
		$regularForType = $currentSite['regularForType'];
		
		$x = -20;
		do {
			$url = $currentSite['url'];
			$x = $x+20;
			$url = $url . $nextPage .$x;
			$res = file_get_contents($url);
			$arrayRes[] = $res;
			preg_match_all($regularForAllItems['first'], $res, $links);
			$linksFromAllPages[] = $links[0];
		} while (!empty($links[0]));
		
		foreach ($linksFromAllPages as $key => $value) {
			if(!empty($value)){
				array_push($allLinks, $value);
			}
		}
		
		$res = implode('', $arrayRes);

		foreach( $allLinks as $key => $link ){
			foreach ($link as $value) {
				$fullLinks = preg_replace($regularForAllItems['second'], $homeUrl, $value);
				$resultLinks[$fullLinks] = $fullLinks;
					
				
			}
		}
		foreach ($resultLinks as $key => $link) {
			foreach ($hrefsFromDb as $keyFromDb => $linkFromDb) {
				if($link == $linkFromDb) {
					unset($resultLinks[$key]);
				}
			}
		}
		
		$pagesResult = $this->multiCurl($resultLinks);
		foreach ($pagesResult as $original_url => $onePage) {
			preg_match($regularForTitle['first'], $onePage, $titles);

			foreach ($titles as $key => $title) {
				$title = preg_replace($regularForTitle['second'], '', $title);
				$title = preg_replace($regularForTitle['third'], '', $title);
			}
			preg_match($regularForOnePageSmallerPice, $onePage, $onePageSmallerPice);
			
			preg_match($regularForPrice['first'], reset($onePageSmallerPice), $prices);

			preg_match($regularForDescription['first'], reset($onePageSmallerPice), $description);

			preg_match_all($regularForImages['first'], reset($onePageSmallerPice), $images);
			
			preg_match($regularForPhone['first'], reset($onePageSmallerPice), $contact);
			
			preg_match($regularForEmail['first'], reset($onePageSmallerPice), $emails);

			preg_match($regularForAuthor['first'], reset($onePageSmallerPice), $authors);

			
			foreach ($authors as $key => $author) {
				$author = preg_replace($regularForAuthor['second'], '', $author);
				$author = preg_replace($regularForAuthor['third'], '', $author);
			
			}
			
			foreach ($emails as $key => $email) {
				$email = preg_replace($regularForEmail['second'], '', $email);
				$email = preg_replace($regularForEmail['third'], '', $email);
				$email = preg_replace($regularForEmail['fourth'], '', $email);
			}

			foreach ($contact as $key => $phone) {
				$phone = preg_replace($regularForPhone['second'], '', $phone);
			}
			foreach ($images as $key => $image) {
				$image = preg_replace($regularForImages['second'], '', $image);
				$image = preg_replace($regularForImages['third'], '', $image);
			
			}



			foreach ($description as $key => $text) {
				$text = preg_replace($regularForDescription['second'], '', $text);
				$text = preg_replace($regularForDescription['third'], '', $text);
				$text = preg_replace($regularForDescription['fourth'], '', $text);
				$text = preg_replace($regularForDescription['fifth'], '', $text);
				
				$announcement_type = array();
				foreach ($keywords as $key => $keyword) {
					if(preg_match("/$keyword/i", $text, $matches)) {
						$announcement_type[] = $matches; 
					}
					
				}
				
				if(empty($announcement_type)) {
					$announcement_type = 'Частное';
				} else {
					$announcement_type = 'Агенство';
				}
				
				if (preg_match($regularForType['first'], $text, $type)) {
					$type = 'Продажа';
				}elseif(preg_match($regularForType['second'], $text, $type)){
					$type = 'Аренда';
				}
				elseif(preg_match($regularForType['third'], $text, $type)){
					$type = 'Покупка';
				}else{
					$type = 'Неизвестно';
				}
			}

			foreach ($prices as $key => $price) {
				$price = preg_replace($regularForPrice['second'], '', $price);
				$price = preg_replace($regularForPrice['third'], '', $price);
			}
			$results[] = array(
				'original_url' => $original_url,
				'email' => $email,
				'announcement_type' => $announcement_type,
				'author' => $author,
				'phone' => $phone,
				'description' => $text,
				'type' => $type,
				'title' => $title,
				'price' => $price,
				'itemPhotos' => $image,
			); 
			
		}
		$this->set(array('results' => $results));
	}

	public function multiCurl($data, $options = array()) {
		$curls = array();
		$result = array();
		$mh = curl_multi_init();
		$options = array();
		
		foreach ($data as $id => $d) {

			$curls[$id] = curl_init();
			// Для каждого url создаем отдельный curl механизм чтоб посылал запрос)

			$url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
			// Если $d это массив (как в случае с пост), то достаем из массива url
			// если это не массив, а уже ссылка - то берем сразу ссылку

			curl_setopt($curls[$id], CURLOPT_URL, $url);
			curl_setopt($curls[$id], CURLOPT_HEADER, 0);
			curl_setopt($curls[$id], CURLOPT_RETURNTRANSFER, 1);

			// Если у нас есть пост данные, тоесть запрос отправляется постом 
			// устанавливаем флаги и добавляем сами данные
			if (is_array($d) && !empty($d['post'])) 
			{
				curl_setopt($curls[$id], CURLOPT_POST, 1);
				curl_setopt($curls[$id], CURLOPT_POSTFIELDS, $d['post']);
			}
		
			// Если указали дополнительные параметры $options то устанавливаем их
			// смотри документацию функции curl_setopt_array
			if (count($options)>0) curl_setopt_array($curls[$id], $options);

			// добавляем текущий механизм к числу работающих параллельно
			curl_multi_add_handle($mh, $curls[$id]);
		}

		// число работающих процессов.
		$running = null;

		// curl_mult_exec запишет в переменную running количество еще не завершившихся
		// процессов. Пока они есть - продолжаем выполнять запросы.
		do { curl_multi_exec($mh, $running); } while($running > 0);

		// Собираем из всех созданных механизмов результаты, а сами механизмы удаляем
		foreach($curls as $id => $c) 
		{
			$result[$id] = curl_multi_getcontent($c);
			curl_multi_remove_handle($mh, $c);
		}

		// Освобождаем память от механизма мультипотоков
		curl_multi_close($mh);
		return $result;

	}

	
}
