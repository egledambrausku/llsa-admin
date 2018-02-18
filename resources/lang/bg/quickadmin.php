<?php

return [
		'user-management' => [		'title' => 'User management',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'fields' => [			'title' => 'Title',		],	],
		'users' => [		'title' => 'Users',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',		],	],
		'coaches' => [		'title' => 'Treneriai',		'fields' => [			'name' => 'Vardas',			'club' => 'Klubas',		],	],
		'clubs' => [		'title' => 'Klubai',		'fields' => [			'title' => 'Pavadinimas',		],	],
		'kids' => [		'title' => 'Vaikai',		'fields' => [			'first-name' => 'Vardas',			'last-name' => 'Pavardė',			'year' => 'Gimimo metai',			'sex' => 'Lytis',			'group' => 'Amžiaus grupė',			'licence' => 'Turi Licenciją',			'coach' => 'Treneris',			'club' => 'Klubas',		],	],
		'competitions' => [		'title' => 'Varžybos',		'fields' => [			'title' => 'Pavadinimas',			'date' => 'Data',		],	],
		'groups' => [		'title' => 'Amžiaus grupės',		'fields' => [			'title' => 'Pavadinimas',			'years' => 'Gimimo metai (imtinai)',		],	],
	'qa_create' => 'Създай',
	'qa_save' => 'Запази',
	'qa_edit' => 'Промени',
	'qa_view' => 'Покажи',
	'qa_update' => 'Обнови',
	'qa_list' => 'Списък',
	'qa_no_entries_in_table' => 'Няма записи в таблицата',
	'qa_custom_controller_index' => 'Персонализиран контролер.',
	'qa_logout' => 'Изход',
	'qa_add_new' => 'Добави нов',
	'qa_are_you_sure' => 'Сигурни ли сте?',
	'qa_back_to_list' => 'Обратно към списъка',
	'qa_dashboard' => 'Табло',
	'qa_delete' => 'Изтрий',
	'quickadmin_title' => 'Test',
];