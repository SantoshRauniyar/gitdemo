#
# TABLE STRUCTURE FOR: team
#

DROP TABLE IF EXISTS team;

CREATE TABLE `team` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `team_title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `team_leader_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `group_creation` int(1) NOT NULL DEFAULT '2',
  `multi_groups_creation` smallint(1) NOT NULL DEFAULT '2',
  `multi_time_zone` smallint(1) NOT NULL DEFAULT '2',
  `multi_currency` smallint(1) NOT NULL DEFAULT '2',
  `leave_management` smallint(1) NOT NULL DEFAULT '2',
  `rejoin` smallint(1) NOT NULL DEFAULT '2',
  `mis_chart` smallint(1) NOT NULL DEFAULT '2',
  `theam` smallint(1) NOT NULL DEFAULT '2',
  `theme_color_code` text NOT NULL,
  `limit_member_size` smallint(1) NOT NULL DEFAULT '2',
  `announcements` smallint(1) NOT NULL DEFAULT '2',
  `subgroup_creation` smallint(1) NOT NULL DEFAULT '2',
  `group_discussion_board` smallint(1) NOT NULL DEFAULT '2',
  `recurrence_task` smallint(1) NOT NULL DEFAULT '2',
  `subsequent_task` smallint(1) NOT NULL DEFAULT '2',
  `budget_task` smallint(1) NOT NULL DEFAULT '2',
  `task_followers` smallint(1) NOT NULL DEFAULT '2',
  `task_approval` smallint(1) NOT NULL DEFAULT '2',
  `task_discussion` smallint(1) NOT NULL DEFAULT '2',
  `auto_abort` smallint(1) NOT NULL DEFAULT '2',
  `reassign_task` smallint(1) NOT NULL DEFAULT '2',
  `subtask` smallint(1) NOT NULL DEFAULT '2',
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for inactive',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `team_leader_id` (`team_leader_id`),
  KEY `plan_id` (`plan_id`),
  CONSTRAINT `team_ibfk_1` FOREIGN KEY (`team_leader_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO team (`id`, `team_title`, `description`, `logo_image`, `team_leader_id`, `plan_id`, `group_creation`, `multi_groups_creation`, `multi_time_zone`, `multi_currency`, `leave_management`, `rejoin`, `mis_chart`, `theam`, `theme_color_code`, `limit_member_size`, `announcements`, `subgroup_creation`, `group_discussion_board`, `recurrence_task`, `subsequent_task`, `budget_task`, `task_followers`, `task_approval`, `task_discussion`, `auto_abort`, `reassign_task`, `subtask`, `status`, `date`) VALUES (4, 'team1', 'desc of team1', '0/624-391929_336535073029127_707653088_n.jpg', 1, 0, 1, 2, 2, 2, 2, 2, 2, 2, '#0004b4', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, '2014-11-03 13:46:58');
INSERT INTO team (`id`, `team_title`, `description`, `logo_image`, `team_leader_id`, `plan_id`, `group_creation`, `multi_groups_creation`, `multi_time_zone`, `multi_currency`, `leave_management`, `rejoin`, `mis_chart`, `theam`, `theme_color_code`, `limit_member_size`, `announcements`, `subgroup_creation`, `group_discussion_board`, `recurrence_task`, `subsequent_task`, `budget_task`, `task_followers`, `task_approval`, `task_discussion`, `auto_abort`, `reassign_task`, `subtask`, `status`, `date`) VALUES (6, 'team 2', 'desc. of team 2', '0/346-wall.JPG', 1, 0, 2, 2, 2, 2, 2, 2, 2, 2, '#dbcf00', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, '2014-11-03 14:31:40');
INSERT INTO team (`id`, `team_title`, `description`, `logo_image`, `team_leader_id`, `plan_id`, `group_creation`, `multi_groups_creation`, `multi_time_zone`, `multi_currency`, `leave_management`, `rejoin`, `mis_chart`, `theam`, `theme_color_code`, `limit_member_size`, `announcements`, `subgroup_creation`, `group_discussion_board`, `recurrence_task`, `subsequent_task`, `budget_task`, `task_followers`, `task_approval`, `task_discussion`, `auto_abort`, `reassign_task`, `subtask`, `status`, `date`) VALUES (7, 'Smart', 'Smart Developer team', '0/1069-60200_Rudraksha-Aum-Shiva-suffix-deviantART-1024X768_1024x768.jpg', 5, 0, 2, 1, 2, 2, 1, 2, 2, 1, '', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, '2014-12-02 22:49:38');
INSERT INTO team (`id`, `team_title`, `description`, `logo_image`, `team_leader_id`, `plan_id`, `group_creation`, `multi_groups_creation`, `multi_time_zone`, `multi_currency`, `leave_management`, `rejoin`, `mis_chart`, `theam`, `theme_color_code`, `limit_member_size`, `announcements`, `subgroup_creation`, `group_discussion_board`, `recurrence_task`, `subsequent_task`, `budget_task`, `task_followers`, `task_approval`, `task_discussion`, `auto_abort`, `reassign_task`, `subtask`, `status`, `date`) VALUES (8, 'Example Team 1', 'desc. of team 1', '0/1048-Jellyfish.jpg', 8, 0, 1, 1, 2, 2, 1, 1, 1, 1, '#fff87c', 2, 2, 2, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, '2014-12-09 04:54:53');
INSERT INTO team (`id`, `team_title`, `description`, `logo_image`, `team_leader_id`, `plan_id`, `group_creation`, `multi_groups_creation`, `multi_time_zone`, `multi_currency`, `leave_management`, `rejoin`, `mis_chart`, `theam`, `theme_color_code`, `limit_member_size`, `announcements`, `subgroup_creation`, `group_discussion_board`, `recurrence_task`, `subsequent_task`, `budget_task`, `task_followers`, `task_approval`, `task_discussion`, `auto_abort`, `reassign_task`, `subtask`, `status`, `date`) VALUES (9, 'Example Team 2', 'desc. of team 2', '', 8, 0, 2, 2, 2, 2, 2, 2, 2, 2, '#72fff4', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, '2014-12-09 04:58:31');


#
# TABLE STRUCTURE FOR: user_roles
#

DROP TABLE IF EXISTS user_roles;

CREATE TABLE `user_roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(20) NOT NULL,
  `team_id` int(10) NOT NULL,
  `created_by_user_id` int(10) NOT NULL,
  `description` text NOT NULL,
  `is_groups` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_add_group_member` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for No',
  `is_delete_group_member` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_group_chat_board` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yea 2 for no',
  `is_theam` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_task_create` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_reassign_task` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_task` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_sub_task` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_complete_task` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_approve_task` smallint(1) NOT NULL DEFAULT '2' COMMENT '1 for yes 2 for no',
  `is_task_discussion` smallint(1) NOT NULL DEFAULT '2',
  `status` smallint(1) NOT NULL DEFAULT '1',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO user_roles (`id`, `user_role_name`, `team_id`, `created_by_user_id`, `description`, `is_groups`, `is_add_group_member`, `is_delete_group_member`, `is_group_chat_board`, `is_theam`, `is_task_create`, `is_reassign_task`, `is_task`, `is_sub_task`, `is_complete_task`, `is_approve_task`, `is_task_discussion`, `status`, `date`) VALUES (1, 'Example Roke 1', 8, 8, 'desc. for role 1', 2, 1, 1, 1, 2, 1, 1, 2, 1, 1, 1, 1, 1, '2014-12-09 05:34:36');
INSERT INTO user_roles (`id`, `user_role_name`, `team_id`, `created_by_user_id`, `description`, `is_groups`, `is_add_group_member`, `is_delete_group_member`, `is_group_chat_board`, `is_theam`, `is_task_create`, `is_reassign_task`, `is_task`, `is_sub_task`, `is_complete_task`, `is_approve_task`, `is_task_discussion`, `status`, `date`) VALUES (2, 'Example Roke 2', 8, 8, 'desc.of copy role 2', 2, 2, 2, 2, 2, 2, 1, 2, 2, 1, 2, 1, 1, '2014-12-09 05:35:59');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `team_id` int(10) DEFAULT NULL,
  `user_role` varchar(20) NOT NULL,
  `birth_date` varchar(20) NOT NULL,
  `gender` smallint(1) NOT NULL COMMENT '1 for male 2 for female',
  `profile_image` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city_id` int(10) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `country_id` int(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0' COMMENT '0 for inactive 1 for active',
  `created_by` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO users (`id`, `user_name`, `password`, `first_name`, `last_name`, `team_id`, `user_role`, `birth_date`, `gender`, `profile_image`, `address`, `city_id`, `state_id`, `country_id`, `email`, `contact_no`, `timezone`, `plan_id`, `ip`, `status`, `created_by`, `date`) VALUES (1, 'Kartik_Shah', 'b3f4388fc5c9c04df9cc4f526b9484ea11aecc6203a7a6f8b75ded926f37a1e23221f45945572d1fef0df2535336933cb811af2ec1f2a5d35b3119a9b05c1318', 'Kartik', 'Shah', NULL, 'Captain', '1990-10-11', 1, '0/578-Hydrangeas.jpg', '\"Arihant Garments\"\r\n1/16,Kevdawadi, Opp. Dhanvarsha Apartment.', 2922, 442, 98, 'shah.kartik912@gmail.com', '9574532720', 'UP55', 1, '0.0.0.0', 1, '', '2014-09-30 05:00:00');
INSERT INTO users (`id`, `user_name`, `password`, `first_name`, `last_name`, `team_id`, `user_role`, `birth_date`, `gender`, `profile_image`, `address`, `city_id`, `state_id`, `country_id`, `email`, `contact_no`, `timezone`, `plan_id`, `ip`, `status`, `created_by`, `date`) VALUES (2, 'Sagar Patel', 'b3f4388fc5c9c04df9cc4f526b9484ea11aecc6203a7a6f8b75ded926f37a1e23221f45945572d1fef0df2535336933cb811af2ec1f2a5d35b3119a9b05c1318', 'Sagar', 'Patel', 4, '1', '1992-08-15', 1, '0/216-Lighthouse.jpg', 'Rajkot.', 2922, 442, 98, 'sagarpatel580@gmail.com', '7766554433', 'UTC', 0, '', 1, '1', '2014-10-01 04:43:09');
INSERT INTO users (`id`, `user_name`, `password`, `first_name`, `last_name`, `team_id`, `user_role`, `birth_date`, `gender`, `profile_image`, `address`, `city_id`, `state_id`, `country_id`, `email`, `contact_no`, `timezone`, `plan_id`, `ip`, `status`, `created_by`, `date`) VALUES (4, 'finaltest', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'finaltest', 'FilantestLname', 4, '6', '2014-09-04', 1, '0/627-Chrysanthemum.jpg', 'Addess.. ', 2922, 442, 98, 'abc@xyz.com', '1234567890', 'UTC', 0, '', 1, '1', '2014-11-29 03:07:39');
INSERT INTO users (`id`, `user_name`, `password`, `first_name`, `last_name`, `team_id`, `user_role`, `birth_date`, `gender`, `profile_image`, `address`, `city_id`, `state_id`, `country_id`, `email`, `contact_no`, `timezone`, `plan_id`, `ip`, `status`, `created_by`, `date`) VALUES (5, 'ashishnimbark', 'e78d09acb6314b7e89344e608bfa6c61c4aebad24ce1726b2789a1e1e877825bef740a8f4093bd9edb31668922e3476e81aecbaa23ea41801041b0a0d7cc4658', 'Ashish', 'Nimbark', NULL, 'Captain', '2014-11-26', 1, '0/636-independenceday_wallpaper_1600x1200.jpg', 'test rajkot address', 2922, 442, 98, 'ashishnimbark@hotmail.com', '01234567890', 'UP55', 1, '0.0.0.0', 1, '', '2014-12-02 22:08:02');
INSERT INTO users (`id`, `user_name`, `password`, `first_name`, `last_name`, `team_id`, `user_role`, `birth_date`, `gender`, `profile_image`, `address`, `city_id`, `state_id`, `country_id`, `email`, `contact_no`, `timezone`, `plan_id`, `ip`, `status`, `created_by`, `date`) VALUES (6, 'dhaval', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Dhaval', 'Bhatt', 7, '7', '2014-10-18', 1, '0/373-chatrapati-shivaji-maharaj.jpg', 'Rajkot Gujarat', 2922, 442, 98, 'dhaval@test.com', '1234567890', 'UP55', 0, '', 1, '5', '2014-12-02 22:52:03');
INSERT INTO users (`id`, `user_name`, `password`, `first_name`, `last_name`, `team_id`, `user_role`, `birth_date`, `gender`, `profile_image`, `address`, `city_id`, `state_id`, `country_id`, `email`, `contact_no`, `timezone`, `plan_id`, `ip`, `status`, `created_by`, `date`) VALUES (8, 'Shah_Kartik', 'b3f4388fc5c9c04df9cc4f526b9484ea11aecc6203a7a6f8b75ded926f37a1e23221f45945572d1fef0df2535336933cb811af2ec1f2a5d35b3119a9b05c1318', 'Shah', 'Kartik', NULL, 'Captain', '1990-10-11', 1, '0/111-Penguins.jpg', 'Same as Kartik Shah', 2922, 442, 98, 'shah_kartik00@yahoo.com', '7600936294', 'UP55', 1, '0.0.0.0', 1, '', '2014-12-09 04:27:10');
INSERT INTO users (`id`, `user_name`, `password`, `first_name`, `last_name`, `team_id`, `user_role`, `birth_date`, `gender`, `profile_image`, `address`, `city_id`, `state_id`, `country_id`, `email`, `contact_no`, `timezone`, `plan_id`, `ip`, `status`, `created_by`, `date`) VALUES (9, 'Govind Kanzaria', 'b3f4388fc5c9c04df9cc4f526b9484ea11aecc6203a7a6f8b75ded926f37a1e23221f45945572d1fef0df2535336933cb811af2ec1f2a5d35b3119a9b05c1318', 'Govind', 'Kanzaria', 8, '1', '1987-12-19', 1, '0/903-Lighthouse.jpg', 'address of Govind Kanzaria', 1553, 442, 98, 'govindpresidentinfoway@gmail.com', '3322116655', 'UP55', 0, '', 1, '8', '2014-12-09 06:11:38');
INSERT INTO users (`id`, `user_name`, `password`, `first_name`, `last_name`, `team_id`, `user_role`, `birth_date`, `gender`, `profile_image`, `address`, `city_id`, `state_id`, `country_id`, `email`, `contact_no`, `timezone`, `plan_id`, `ip`, `status`, `created_by`, `date`) VALUES (10, 'Ravatsinh Sisodiya', 'b3f4388fc5c9c04df9cc4f526b9484ea11aecc6203a7a6f8b75ded926f37a1e23221f45945572d1fef0df2535336933cb811af2ec1f2a5d35b3119a9b05c1318', 'Ravatsinh', 'Sisodiya', 8, '2', '1990-02-08', 1, '', 'Address of Ravatsinh Sisodiya', 1631, 442, 98, 'ravatsinh.presidentinfoway@gmail.com', '1122334455', 'UP55', 0, '', 1, '8', '2014-12-09 06:20:40');


#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS groups;

CREATE TABLE `groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `groups_title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `team_id` int(10) NOT NULL,
  `manager_id` int(10) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for inactive',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `manager_id` (`manager_id`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO groups (`id`, `groups_title`, `description`, `team_id`, `manager_id`, `status`, `date`) VALUES (3, 'Group 1', 'desc. of group 1', 4, 2, 1, '2014-11-03 14:35:59');
INSERT INTO groups (`id`, `groups_title`, `description`, `team_id`, `manager_id`, `status`, `date`) VALUES (4, 'Example Group 1', 'desc. of example group 1', 8, 9, 1, '2014-12-09 06:31:17');


#
# TABLE STRUCTURE FOR: group_members
#

DROP TABLE IF EXISTS group_members;

CREATE TABLE `group_members` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for inactive',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO group_members (`id`, `group_id`, `member_id`, `status`, `date`) VALUES (1, 4, 10, 1, '2014-12-09 06:31:17');


#
# TABLE STRUCTURE FOR: projects
#

DROP TABLE IF EXISTS projects;

CREATE TABLE `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `team_id` int(10) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `no_of_milestone` int(2) NOT NULL,
  `budget` varchar(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1 for assign 2 for panding 3 for complete',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `leader_id` (`team_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO projects (`id`, `project_name`, `description`, `team_id`, `start_date`, `end_date`, `no_of_milestone`, `budget`, `created_by`, `status`, `date`) VALUES (5, 'project 1', 'desc. of project 1', 4, '2014-11-04', '2014-11-05', 6, '20000', 1, 1, '2014-11-03 22:23:28');
INSERT INTO projects (`id`, `project_name`, `description`, `team_id`, `start_date`, `end_date`, `no_of_milestone`, `budget`, `created_by`, `status`, `date`) VALUES (6, 'Example Project-1', 'desc. of project-1', 8, '2014-12-01', '2014-12-31', 5, '20000', 8, 1, '2014-12-09 06:35:25');


#
# TABLE STRUCTURE FOR: milestone
#

DROP TABLE IF EXISTS milestone;

CREATE TABLE `milestone` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `milestone_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `budget` varchar(10) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `milestone_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO milestone (`id`, `project_id`, `milestone_title`, `description`, `budget`, `status`, `date`) VALUES (2, 5, 'milestone 1', 'desc. of milestone 1', '10000', 1, '2014-11-04 00:09:26');
INSERT INTO milestone (`id`, `project_id`, `milestone_title`, `description`, `budget`, `status`, `date`) VALUES (3, 6, 'Example Milestione-1', 'desc.of milestone-1', '4000', 1, '2014-12-09 06:37:00');


#
# TABLE STRUCTURE FOR: task
#

DROP TABLE IF EXISTS task;

CREATE TABLE `task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `task` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(10) DEFAULT NULL,
  `milestone_id` int(10) DEFAULT NULL,
  `member_id` varchar(20) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `task_mode` int(1) NOT NULL DEFAULT '1' COMMENT '1 for perent 2 for child',
  `parent_id` int(10) NOT NULL,
  `task_type` int(10) NOT NULL,
  `task_priority` smallint(1) NOT NULL,
  `recurrence` int(1) NOT NULL DEFAULT '2' COMMENT '1 for Yes 2 for No',
  `recurrence_start_date` varchar(20) NOT NULL,
  `recurrence_end_date` varchar(20) NOT NULL,
  `no_of_recurrence` varchar(10) NOT NULL,
  `frequency_type` int(1) NOT NULL COMMENT '1 fix 2 custom',
  `fix_time` int(1) NOT NULL COMMENT '1=EveryHower 2=EveryDay 3=EveryWeek 4=EveryFortnight 5=EveryMonth 6=EveryHalfyear 7=EveryYear',
  `budget` varchar(10) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `milestone_id` (`milestone_id`),
  KEY `task_type` (`task_type`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`milestone_id`) REFERENCES `milestone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `task_ibfk_2` FOREIGN KEY (`task_type`) REFERENCES `task_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `task_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO task (`id`, `task`, `description`, `project_id`, `milestone_id`, `member_id`, `start_date`, `end_date`, `task_mode`, `parent_id`, `task_type`, `task_priority`, `recurrence`, `recurrence_start_date`, `recurrence_end_date`, `no_of_recurrence`, `frequency_type`, `fix_time`, `budget`, `status`, `date`) VALUES (1, 'sdfsdfsdfsdfsdf', 'fsdfsdfsdfsdfsdf', NULL, NULL, 'user_2', '2014-10-08', '2014-10-10', 1, 0, 2, 1, 2, '', '', '', 0, 0, '200', 1, '2014-10-10 00:34:02');
INSERT INTO task (`id`, `task`, `description`, `project_id`, `milestone_id`, `member_id`, `start_date`, `end_date`, `task_mode`, `parent_id`, `task_type`, `task_priority`, `recurrence`, `recurrence_start_date`, `recurrence_end_date`, `no_of_recurrence`, `frequency_type`, `fix_time`, `budget`, `status`, `date`) VALUES (2, 'Test One', 'demo', 5, 2, 'user_2', '2014-11-06', '2014-11-07', 2, 1, 1, 3, 1, '2014-11-08', '2014-11-11', '4', 1, 2, '100', 4, '2014-11-06 04:01:07');
INSERT INTO task (`id`, `task`, `description`, `project_id`, `milestone_id`, `member_id`, `start_date`, `end_date`, `task_mode`, `parent_id`, `task_type`, `task_priority`, `recurrence`, `recurrence_start_date`, `recurrence_end_date`, `no_of_recurrence`, `frequency_type`, `fix_time`, `budget`, `status`, `date`) VALUES (3, 'Final Task Test', 'final test descriptions ', 5, 2, 'user_1', '2014-11-25', '2014-11-30', 1, 0, 1, 4, 2, '', '', '', 0, 0, '100', 1, '2014-11-25 01:53:37');
INSERT INTO task (`id`, `task`, `description`, `project_id`, `milestone_id`, `member_id`, `start_date`, `end_date`, `task_mode`, `parent_id`, `task_type`, `task_priority`, `recurrence`, `recurrence_start_date`, `recurrence_end_date`, `no_of_recurrence`, `frequency_type`, `fix_time`, `budget`, `status`, `date`) VALUES (4, 'Example task-1', 'desc of task-1', 6, 3, 'user_9', '2014-12-01', '2014-12-02', 1, 0, 1, 3, 2, '', '', '', 0, 0, '3000', 1, '2014-12-09 06:46:34');


#
# TABLE STRUCTURE FOR: task_comments
#

DROP TABLE IF EXISTS task_comments;

CREATE TABLE `task_comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `task_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1 for active 2 for inactive ',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO task_comments (`id`, `task_id`, `user_id`, `comment`, `status`, `date`) VALUES (1, 2, 1, 'hi hello', 1, '2014-11-11 05:45:47');
INSERT INTO task_comments (`id`, `task_id`, `user_id`, `comment`, `status`, `date`) VALUES (2, 2, 1, 'This is task discussion window.', 1, '2014-11-11 05:50:02');
INSERT INTO task_comments (`id`, `task_id`, `user_id`, `comment`, `status`, `date`) VALUES (3, 2, 1, 'hello how are you...?', 1, '2014-11-11 05:52:47');
INSERT INTO task_comments (`id`, `task_id`, `user_id`, `comment`, `status`, `date`) VALUES (4, 1, 1, 'this is early task discussion window', 1, '2014-11-11 05:55:46');
INSERT INTO task_comments (`id`, `task_id`, `user_id`, `comment`, `status`, `date`) VALUES (5, 1, 1, 'that is not useful ', 1, '2014-11-11 05:56:28');
INSERT INTO task_comments (`id`, `task_id`, `user_id`, `comment`, `status`, `date`) VALUES (6, 0, 1, 'hi', 1, '2014-11-25 01:57:13');
INSERT INTO task_comments (`id`, `task_id`, `user_id`, `comment`, `status`, `date`) VALUES (7, 0, 1, 'hi', 1, '2014-11-25 01:57:33');


#
# TABLE STRUCTURE FOR: task_followers
#

DROP TABLE IF EXISTS task_followers;

CREATE TABLE `task_followers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `task_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1 for active 2 for inactive',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `task_followers_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `task_followers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

