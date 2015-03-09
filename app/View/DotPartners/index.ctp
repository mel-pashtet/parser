<div id="partners">
	<h2> Контрагенты </h2>
	<div id="grid"></div>
	<div id="modal"></div>
	<div id="details"></div>
	<div id="addPrice"></div>
	<script>
		var wnd,
			detailsTemplate;
		$(function() {
			var dataSource = new kendo.data.DataSource({
				serverPaging: true,
				serverSorting: true,
				aggregate: [
						{ field: "price_lead", aggregate: "min" },
						{ field: "price_lead", aggregate: "max" }
				],
				transport: {
					read: {
						url:"<?php echo $this->Html->url('/DotPartners/getPartners',true)?>",
						dataType:"json",
					},
					update: {
						url:"<?php echo $this->Html->url('/DotPartners/update',true)?>",
						type:"PUT"
					},
					destroy: {
						url: "<?php echo $this->Html->url('/DotPartners/delete',true)?>",
						type:"PUT"
					},
					create: {
						url :"<?php echo $this->Html->url('/DotPartners/create',true)?>",
						type:"PUT"
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
								type: "string",
								validation: {
									required: true,
								}
							},
							"secret_key": {
								type: "string",
								validation: {
									required: true,
								}
							},
							"description": {
								type: "string"
							},
							"price_lead": {
								type: "number",
								validation: { min: 0}

							}
						}
					}
				},
				serverFiltering: true,
				
				pageSize: 5
			});

		$("#grid").kendoGrid({
			dataSource: dataSource,
			edit: function(e) {
				e.container.data("kendoWindow").bind("close", function () {
					$("#grid").data("kendoGrid").dataSource.read();
				})
			},
			// remove: function(e) {
			// 	$("#grid").data("kendoGrid").dataSource.read();
			// },
			
			columns: [
				{ field: "id", title: 'ID'},
				{ field: "name", title: 'Имя'},
				{ field: "secret_key", title: 'Секретный ключ'},
				{ field: "description", title: 'Описание'},
				{ field: "price_lead", title: 'Цена лида',
					footerTemplate: "Min: #: min # Max: #: max #"
				},
				{ command: [
					{ name: "edit", text: "" },
					{ name: "destroy", text: "" },
					],
					title: "Управления"
				},
				{
					command: [
						{ text: "Цены товаров", click: getPrice },
						{ text: "Добавить товар", click: addPrice },

					],
					title: "Управления товарами"
				}
			],
			editable: "popup",
			toolbar: [
				//name - название команд, text - текст который будет видеть пользователь
				{ name: "create", text: "Создать" }//,
			],
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
						// contains: "Содержит"
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

		wnd = $("#details")
			.kendoWindow({
				title: "Добавленые товары",
				modal: true,
				visible: false,
				resizable: true,
				height: 420,
				width: 1500,
				close: function(e) {
				}
			}).data("kendoWindow");


		wndAdd = $("#addPrice")
			.kendoWindow({
				title: "Еще не добавленые товары",
				modal: true,
				visible: false,
				resizable: true,
				height: 420,
				width: 1500,
				close: function(e) {
				}
			}).data("kendoWindow");

		});
		
		function getPrice(e) {
			e.preventDefault();

			var dataItem = this.dataItem($(e.currentTarget).closest("tr"));

			
			wnd.refresh({
				url: "<?php echo $this->Html->url('/DotPartnerGoods/index',true)?>?id=" + dataItem.id ,
			});
			wnd.center().open();

		};

		function addPrice(e) {
			e.preventDefault();

			var dataItem = this.dataItem($(e.currentTarget).closest("tr"));

			
			wndAdd.refresh({
				url: "<?php echo $this->Html->url('/DotPartnerGoods/addPrice',true)?>?id=" + dataItem.id ,
			});
			wndAdd.center().open();

		};

		



	</script>
	
</div>