DELETE FROM `user` WHERE `username` <> 'tiger';
DELETE FROM `user_address`;
DELETE FROM `user_contact`;

DELETE FROM `org` WHERE `orgname` <> 'tiger' OR `orgname` IS NULL;
DELETE FROM `org_address`;
DELETE FROM `org_contact`;

DELETE FROM `org_user`;

DELETE FROM `contact`;
DELETE FROM `address`;

DELETE FROM `session`;
DELETE FROM `login`;
DELETE FROM `log_application`;
DELETE FROM `translation` WHERE `msg_id` <> 'PASSWORD.DESCRIPTION';
DELETE FROM `login`;
DELETE FROM `config`;