<?php
	class MultiCurlComponent extends Component {
		
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
?>