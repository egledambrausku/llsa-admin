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
	'quickadmin_title' => 'Test',
];