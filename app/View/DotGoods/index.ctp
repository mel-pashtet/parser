<div id="example">
	<h2> Товары </h2>
	<div id="grid"></div>
	<script>
	    $(function() {
		  var dataSource = new kendo.data.DataSource({
			serverPaging: true,
			serverSorting: true,
			serverFiltering: true,
			pageSize: 5,
			aggregate: [
					{ field: "price_vozv", aggregate: "min" },
					{ field: "price_vozv", aggregate: "max" },
					{ field: "price_zakup", aggregate: "min" },
					{ field: "price_zakup", aggregate: "max" },
					{ field: "price_prod", aggregate: "min" },
					{ field: "price_prod", aggregate: "max" },
			],   
			transport: {
				read: {
					url:"<?php echo $this->Html->url('/DotGoods/getGoods',true)?>",
					dataType:"json",
				},
				update: {
					url:"<?php echo $this->Html->url('/DotGoods/update',true)?>",
					type:"PUT"
				},
				destroy: {
					url: "<?php echo $this->Html->url('/DotGoods/delete',true)?>",
					type:"PUT"
				},
				create  :{
					url :"<?php echo $this->Html->url('/DotGoods/create',true)?>",
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
						"alias": {
							type: "string",
							validation: {
								required: true,
							}
						},
						"name": {
							type: "string",
							validation: {
								required: true,
							}
						},
						"price_vozv": {
							type: "number",
							validation: { min: 0}
						},
						"price_zakup": {
							type: "number",
							validation: { min: 0}
						},
						"price_prod": {
							type: "number",
							validation: { min: 0}
						},
						"is_return": {
							type: "boolean"
						}
					}
				}
			}
		  });
		  
		  $("#grid").kendoGrid({
			edit: function(e) {
				e.container.data("kendoWindow").bind("close", function () {
					$("#grid").data("kendoGrid").dataSource.read();
				})
			},
			// remove: function(e) {
			// 	var grid = $("#grid").data("kendoGrid");
			// 	grid.refresh();
			// },
			
			dataSource: dataSource,         
			columns: [
				{ field: "id", title: 'ID'},
				{ field: "alias", title: 'Алиас'},
				{ field: "name", title: 'Имя'},
				{ field: "price_vozv", title: 'Цена возврата',
					footerTemplate: "Min: #: min # Max: #: max #"
				},
				{ field: "price_zakup", title: 'Цена закупки',
					footerTemplate: "Min: #: min # Max: #: max #"
				},
				{ field: "price_prod", title: 'Цена продажи',
					footerTemplate: "Min: #: min # Max: #: max #"
				},
				{ field: "is_return", title: 'Возврат'},
				{ command: 
					[
						{ name: "edit", text: "" },
						{ name: "destroy", text: "" },
					],
					title: "Управления"
				},
			],
			editable: "popup",
			toolbar: [
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

	    });
	
	</script>
  </div>