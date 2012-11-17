<?php

App::uses('Security', 'Utility');
App::uses('CakeTime', 'Utility');

class Initial extends CakeMigration {

	/**
	 * Migration description
	 *
	 * @var string
	 * @access public
	 */
	public $description = 'Version initiale de la base de données';

	/**
	 * Actions to be performed
	 *
	 * @var array $migration
	 * @access public
	 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'blog_articles' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200),
					'content' => array('type' => 'text', 'null' => false, 'default' => null),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'character_classes' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'character_specs' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'class' => array('type' => 'integer', 'null' => false, 'default' => null),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50),
					'recruitment_active' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'characters' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'class' => array('type' => 'integer', 'null' => false, 'default' => null),
					'user' => array('type' => 'integer', 'null' => false, 'default' => null),
					'realm' => array('type' => 'integer', 'null' => false, 'default' => null),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25),
					'in_roster' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'encounter_zones' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null),
					'num_bosses' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'normal_progress' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'heroic_progress' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'position' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'encounters' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'zone' => array('type' => 'integer', 'null' => false, 'default' => null),
					'name' => array('type' => 'string', 'null' => false, 'default' => null),
					'normal' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'heroic' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'position' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'event_participants' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'event' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
					'user' => array('type' => 'integer', 'null' => false, 'default' => null),
					'character' => array('type' => 'integer', 'null' => false, 'default' => null),
					'status' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'confirmed' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'message' => array('type' => 'string', 'null' => true, 'default' => null),
					'answered' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true),
						'event' => array('column' => array('event', 'user'), 'unique' => true)
					)
				),
				'event_statuses' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50),
					'position' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'event_types' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null),
					'image' => array('type' => 'string', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'events' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50),
					'description' => array('type' => 'string', 'null' => true, 'default' => null),
					'type' => array('type' => 'integer', 'null' => false, 'default' => null),
					'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'begin' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'forum_accesses' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'group' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
					'forum' => array('type' => 'integer', 'null' => false, 'default' => null),
					'view' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'reply' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'create' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'moderate' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true),
						'group' => array('column' => array('group', 'forum'), 'unique' => true)
					)
				),
				'forum_categories' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null),
					'position' => array('type' => 'integer', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'forum_posts' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'topic' => array('type' => 'integer', 'null' => false, 'default' => null),
					'content' => array('type' => 'text', 'null' => false, 'default' => null),
					'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'edited_by' => array('type' => 'integer', 'null' => true, 'default' => null),
					'edited' => array('type' => 'datetime', 'null' => true, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'forum_topics' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'forum' => array('type' => 'integer', 'null' => false, 'default' => null),
					'title' => array('type' => 'string', 'null' => false, 'default' => null),
					'num_views' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'num_replies' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'first_post' => array('type' => 'integer', 'null' => false, 'default' => null),
					'last_post' => array('type' => 'integer', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'forums' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'category' => array('type' => 'integer', 'null' => false, 'default' => null),
					'name' => array('type' => 'string', 'null' => false, 'default' => null),
					'description' => array('type' => 'string', 'null' => true, 'default' => null),
					'position' => array('type' => 'integer', 'null' => false, 'default' => null),
					'num_topics' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'gallery_images' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'file' => array('type' => 'string', 'null' => false, 'default' => null),
					'caption' => array('type' => 'string', 'null' => true, 'default' => null),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'groups' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50),
					'color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 6),
					'level' => array('type' => 'integer', 'null' => false, 'default' => 0),
					'allow_delete' => array('type' => 'boolean', 'null' => false, 'default' => true),
					'visible' => array('type' => 'boolean', 'null' => false, 'default' => true),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'groups_roles' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'group' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
					'role' => array('type' => 'integer', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true),
						'role' => array('column' => array('group', 'role'), 'unique' => true)
					)
				),
				'pages' => array(
					'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'key' => 'primary'),
					'title' => array('type' => 'string', 'null' => false, 'default' => null),
					'content' => array('type' => 'text', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'realms' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null),
					'slug' => array('type' => 'string', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				),
				'roles' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25, 'key' => 'unique'),
					'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 150),
					'level' => array('type' => 'integer', 'null' => false, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true),
						'UNIQUE' => array('column' => 'key', 'unique' => true)
					)
				),
				'users' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20),
					'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50),
					'last_login' => array('type' => 'datetime', 'null' => true, 'default' => null),
					'last_ip' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 15),
					'password' => array('type' => 'string', 'null' => false, 'default' => null),
					'salt' => array('type' => 'string', 'null' => true, 'default' => null),
					'group' => array('type' => 'integer', 'null' => false, 'default' => null),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'active' => array('type' => 'boolean', 'null' => false, 'default' => false),
					'presentation' => array('type' => 'text', 'null' => true, 'default' => null),
					'gravatar_hash' => array('type' => 'string', 'null' => true, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => true)
					)
				)
			)
		),
		'down' => array(
			'drop_table' => array(
				'blog_articles', 
				'character_classes', 
				'character_specs', 
				'characters', 
				'encounter_zones', 
				'encounters', 
				'event_participants', 
				'event_statuses', 
				'event_types', 
				'events', 
				'forum_accesses', 
				'forum_categories', 
				'forum_posts', 
				'forum_topics', 
				'forums', 
				'gallery_images', 
				'groups', 
				'groups_roles', 
				'pages', 
				'realms', 
				'roles', 
				'users'
			)
		)
	);

	/**
	 * Before migration callback
	 *
	 * @param string $direction, up or down direction of migration process
	 * @return boolean Should process continue
	 * @access public
	 */
	public function before($direction) {
		return true;
	}

	/**
	 * After migration callback
	 *
	 * @param string $direction, up or down direction of migration process
	 * @return boolean Should process continue
	 * @access public
	 */
	public function after($direction) {
		if (isset($this->callback) && $direction == 'up') {
			/**
			 * Initialisation de la table character_classes
			 */
			$this->callback->out("Initialisation de la table character_classes...");

			$CharacterClass = ClassRegistry::init('CharacterClass');

			$CharacterClass->create();
			$CharacterClass->saveMany(array(
				array('id' => 1, 'name' => 'Guerrier'),
				array('id' => 2, 'name' => 'Paladin'),
				array('id' => 3, 'name' => 'Chasseur'),
				array('id' => 4, 'name' => 'Voleur'),
				array('id' => 5, 'name' => 'Prêtre'),
				array('id' => 6, 'name' => 'Chevalier de la mort'),
				array('id' => 7, 'name' => 'Chaman'),
				array('id' => 8, 'name' => 'Mage'),
				array('id' => 9, 'name' => 'Démoniste'),
				array('id' => 10, 'name' => 'Moine'),
				array('id' => 11, 'name' => 'Druide')
			));

			/**
			 * Initialisation de la table character_specs
			 */
			$this->callback->out("Initialisation de la table character_specs...");

			$CharacterSpec = ClassRegistry::init('CharacterSpec');

			$CharacterSpec->create();
			$CharacterSpec->saveMany(array(
				array('class' => 1, 'name' => 'Armes'),
				array('class' => 1, 'name' => 'Fureur'),
				array('class' => 1, 'name' => 'Protection'),
				array('class' => 2, 'name' => 'Protection'),
				array('class' => 2, 'name' => 'Sacré'),
				array('class' => 2, 'name' => 'Vindicte'),
				array('class' => 3, 'name' => 'Survie'),
				array('class' => 3, 'name' => 'Précision'),
				array('class' => 3, 'name' => 'Maîtrise des bêtes'),
				array('class' => 4, 'name' => 'Combat'),
				array('class' => 4, 'name' => 'Finesse'),
				array('class' => 4, 'name' => 'Assassinat'),
				array('class' => 5, 'name' => 'Sacré'),
				array('class' => 5, 'name' => 'Discipline'),
				array('class' => 5, 'name' => 'Ombre'),
				array('class' => 6, 'name' => 'Impie'),
				array('class' => 6, 'name' => 'Givre'),
				array('class' => 6, 'name' => 'Sang'),
				array('class' => 7, 'name' => 'Elémentaire'),
				array('class' => 7, 'name' => 'Amélioration'),
				array('class' => 7, 'name' => 'Restauration'),
				array('class' => 8, 'name' => 'Arcanes'),
				array('class' => 8, 'name' => 'Feu'),
				array('class' => 8, 'name' => 'Givre'),
				array('class' => 9, 'name' => 'Destruction'),
				array('class' => 9, 'name' => 'Démonologie'),
				array('class' => 9, 'name' => 'Afflication'),
				array('class' => 10, 'name' => 'Maître brasseur'),
				array('class' => 10, 'name' => 'Tisse-brume'),
				array('class' => 10, 'name' => 'Marche-vent'),
				array('class' => 11, 'name' => 'Equilibre'),
				array('class' => 11, 'name' => 'Combat farouche'),
				array('class' => 11, 'name' => 'Restauration')
			));

			/**
			 * Initialisation de la table groups
			 */
			$this->callback->out("Initialisation de la table groups...");

			$Group = ClassRegistry::init('Group');

			$Group->create();
			$Group->saveMany(array(
				array('id' => 1, 'name' => 'Invité', 'allow_delete' => false, 'visible' => false),
				array('id' => 2, 'name' => 'Administrateur', 'level' => 255, 'allow_delete' => false, 'visible' => false),
				array('id' => 3, 'name' => 'Utilisateur enregistré', 'level' => 255, 'allow_delete' => false, 'visible' => true)
			));

			/**
			 * Initialisation de la table pages
			 */
			$this->callback->out("Initialisation de la table pages...");

			$Page = ClassRegistry::init('Page');

			$Page->create();
			$Page->saveMany(array(
				array('id' => 'rules', 'title' => 'Charte de bonne conduite', 'content' => '')
			));

			/**
			 * Initialisation de la table realms
			 */
			$this->callback->out("Initialisation de la table realms...");

			$User = ClassRegistry::init('Realm');

			$User->create();
			$User->saveMany(array(
				array('name' => 'La Croisade écarlate', 'slug' => 'la-croisade-ecarlate')
			));

			/**
			 * Initialisation de la table roles
			 */
			$this->callback->out("Initialisation de la table roles...");

			$Role = ClassRegistry::init('Role');

			$Role->create();
			$Role->saveMany(array(
				array('key' => 'edit_rules', 'name' => 'Modifier la charte de bonne conduite', 'level' => 2),
				array('key' => 'create_event', 'name' => 'Créer des événements', 'level' => 0),
				array('key' => 'join_event', 'name' => 'Participer aux événements', 'level' => 0),
				array('key' => 'manage_blog', 'name' => 'Gérer le blog', 'level' => 2),
				array('key' => 'manage_gallery', 'name' => 'Gérer la galerie', 'level' => 2),
				array('key' => 'manage_roster', 'name' => 'Gérer le roster de la guilde', 'level' => 2),
				array('key' => 'manage_recruitment', 'name' => 'Gérer l\'état du recrutement', 'level' => 1),
				array('key' => 'manage_encounters', 'name' => 'Gérer l\'avancée raids', 'level' => 1),
				array('key' => 'moderate_events', 'name' => 'Modérer les événements', 'level' => 2),
				array('key' => 'manage_forums', 'name' => 'Gérer les forums', 'level' => 2),
				array('key' => 'manage_groups', 'name' => 'Gérer les groupes d\'utilisateurs', 'level' => 3),
				array('key' => 'moderate_users', 'name' => 'Modérer les utilisateurs', 'level' => 1)
			));
			
			/**
			 * Initialisation de la table users
			 */
			$this->callback->out();
			$this->callback->out("Informations sur le compte administrateur");
			
			$username = $this->callback->in("Nom d'utilisateur :");
			$email = $this->callback->in("Adresse e-mail :");
			$password = $this->callback->in("Mot de passe :");
			
			$this->callback->out();
			$this->callback->out("Initialisation de la table users...");

			$User = ClassRegistry::init('User');

			$User->create();
			$User->saveMany(array(
				array('id' => 2, 'username' => $username, 'email' => $email, 'password' => $password, 'group' => 2, 'created' => CakeTime::toServer(time()), 'active' => true)
			));
		}

		return true;
	}
}
