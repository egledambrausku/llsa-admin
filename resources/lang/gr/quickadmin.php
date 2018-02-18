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
	'qa_create' => 'Δημιουργία',
	'qa_save' => 'Αποθήκευση',
	'qa_edit' => 'Επεξεργασία',
	'qa_view' => 'Εμφάνιση',
	'qa_update' => 'Ενημέρωησ',
	'qa_list' => 'Λίστα',
	'qa_no_entries_in_table' => 'Δεν υπάρχουν δεδομένα στην ταμπέλα',
	'qa_custom_controller_index' => 'index προσαρμοσμένου controller.',
	'qa_logout' => 'Αποσύνδεση',
	'qa_add_new' => 'Προσθήκη νέου',
	'qa_are_you_sure' => 'Είστε σίγουροι;',
	'qa_back_to_list' => 'Επιστροφή στην λίστα',
	'qa_dashboard' => 'Dashboard',
	'qa_delete' => 'Διαγραφή',
	'quickadmin_title' => 'Test',
];