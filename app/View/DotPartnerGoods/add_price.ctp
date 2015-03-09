<html>
	<head>
			
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $this->fetch('title'); ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css('/kengoGrid/styles/kendo.common-bootstrap.min');
			echo $this->Html->css('/kengoGrid/styles/kendo.bootstrap.min');
			echo $this->Html->css('/kengoGrid/styles/kendo.common.min');
			echo $this->Html->css('/kengoGrid/styles/kendo.blueopal.min');
			echo $this->Html->css('/kengoGrid/styles/kendo.dataviz.min');
			echo $this->Html->css('/kengoGrid/styles/kendo.dataviz.default.min');
			echo $this->Html->script('/kengoGrid/js/jquery.min');
			echo $this->Html->script('/kengoGrid/js/kendo.all.min');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<div id="example">
			<div id="modalAddPrice"></div>
			<script>
				$(function() {
					id = "<?php echo $id?>";
					var dataSource = new kendo.data.DataSource({
					serverPaging: true,
					serverSorting: true,
					serverFiltering: true,
					pageSize: 5,
					aggregate: [
							{ field: "price_define", aggregate: "min" },
							{ field: "price_define", aggregate: "max" },
							{ field: "price_lead_define", aggregate: "min" },
							{ field: "price_lead_define", aggregate: "max" },
							{ field: "price_prod", aggregate: "min" },
							{ field: "price_prod", aggregate: "max" },
					],
					transport: {
						read: {
							url:"<?php echo $this->Html->url('/DotPartnerGoods/getNotDefinePartnerGoods',true)?>?id=" + id ,
							dataType:"json",
						},
					},
					schema: {
						data: 'data',
						total:"total",
						model: {
							id: "id",
							fields: {
								"id": {
									type: "number",
									editable: false
								},
								"name": {
									editable: false
								},
								"alias": {
									editable: false
								},
								"price_prod": {
									type: "number",
									editable: false
								},
								"price_define": {
									type: "number",
									validation: { min: 0}
								},
								"price_lead_define": {
									type: "number",
									validation: { min: 0}
								}
							}
						}
					}
				  });

					var modalGrid = $("#modalAddPrice").kendoGrid({
						edit: function(e) {
							e.container.data("kendoWindow").bind("close", function () {
								$("#modalAddPrice").data("kendoGrid").dataSource.read();
							})
						},
						dataSource: dataSource,
						columns: [
							{ field: "id", title: 'ID'},
							{ field: "alias", title: 'Алиас'},
							{ field: "name", title: 'Имя'},
							{ field: "price_prod", title: 'Цена продажи',
								attributes: {
									style: "background-color: red"
								},
								footerTemplate: "Min: #: min # Max: #: max #"
							},
							{ field: "price_define", title: 'Цена переопределенная',
								attributes: {
									style: "background-color: green"
								},
								footerTemplate: "Min: #: min # Max: #: max #"
							},
							{ field: "price_lead_define", title: 'Цена лида переопределенная',
								attributes: {
									style: "background-color: blue"
								},
								footerTemplate: "Min: #: min # Max: #: max #"
							},
							{
								command: { text: "Добавить", click: addPG },
							}
						],
								editable: "popup",
								refresh: true,
								groupable: false,
								scrollable: true,
								sortable: true,
								resizable: true,
								numeric: true,
								columnMenu: true,
								reorderable: false,
								filterable: {
									mode: "row",
									messages: {
										info: "Фильтры:", // текст для заголовка окна фильтров
										filter: "Применить", // текст для кнопки, применяющей фильтры
										clear: "Очистить", // текст для кнопки, сбрасывающей фильтры
										// Если фильтруемое поле имеет Boolean тип
										isTrue: "Да", // текст для радио кнопки для true
										isFalse: "Нет", // текст для радио кнопки для false
										//Изменяем тект операций фильтрации
										and: "И",
										or: "Или"
									},
									operators: {
										//меню фильтров для Строкового поля
										string: {
											eq: "Такое же как",
											neq: "Не такое же как",
										},
										//меню фильтров Числового поля
										number: {
											eq: "=",
											neq: "!=",
										},
									}
								},
								columnMenu: {
									messages: {
										sortAscending: "Сортировка по возрастанию",
										sortDescending: "Сортировка по убыванию",
										filter: "Фильтры",
										columns: "Поля"
									}
								},
								pageable: {
									pageSizes: [5, 10, 25, 50],
									refresh: true,
									buttonCount: 10,
									messages: {
										display: "{0} - {1} из {2} записей",
										empty: "Элементы отсутствуют",
										page: "Страницы",
										of: "из {0}", //{0} кол-ва элементов на странице
										itemsPerPage: "Элементов на странице",
										first: "К первой странице",
										previous: "К предыдущей странице",
										next: "К следущей странице",
										last: "К последней странице",
										refresh: "Обновить"
									}
								}
					});
				});

			function addPG(e) {
				e.preventDefault();

				var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
				
				$.ajax(
			  	{
				
					type: 'POST',
				
					url: "<?php echo $this->Html->url('/DotPartnerGoods/create',true)?>?partner_id=" + id + "&good_id=" +dataItem.id,
					
					success: function (result) {
						$('#modalAddPrice').data('kendoGrid').dataSource.read();
					
					}
			});
				
			};
			</script>
		  </div>
		  <style>
			body {
				background-color: #94c0d2;
			}
		  </style>
	</body>
</html>