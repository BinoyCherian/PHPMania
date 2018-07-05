DELIMITER $$
	CREATE PROCEDURE exam_reset(effect_date DATETIME)
	BEGIN
		SET FOREIGN_KEY_CHECKS=0;
		
		TRUNCATE TABLE evaluation; #--done
		TRUNCATE TABLE group_member; #--done
		TRUNCATE TABLE quiz_db; #--done
		TRUNCATE TABLE sheet; #--done
		TRUNCATE TABLE sql_answer;
		TRUNCATE TABLE sql_question; #--done
		TRUNCATE TABLE sql_quiz; #--done
		TRUNCATE TABLE sql_quiz_question; #--done
		TRUNCATE TABLE theme; #--done
		TRUNCATE TABLE trainer; #--done
		TRUNCATE TABLE user; #--done
		TRUNCATE TABLE usergroup; 
		
		
		SET FOREIGN_KEY_CHECKS=1;

		START TRANSACTION;

		INSERT INTO user(user_id,email,pwd,name,first_name,token,created_at,validated_at) VALUES
		(1, 'haddock@moulinsart.be', 'capitaine', 'Haddock', 'Archibald', 'xys123asd_ad1', '2018-09-16 00:00:00', '2018-09-17 00:00:00'),
		(2, 'trainer@moulinsart.be', 'capitaine2', 'Trainer', 'Stephen', 'xys123asd_ad12', '2018-09-18 00:00:00', '2018-09-19 00:00:00'),
		(3, 'teacher@moulinsart.be', 'capitaine3', 'Trainer', 'Mohit', 'asd_1we88s', '2018-09-19 00:00:00', '2018-09-20 00:00:00'),
		(4, 'thejus@thejus.fr', 'thejus123', 'thejus', 'THEJUS', 'adasd*7687A_asd', '2017-09-19 00:00:00', '2017-09-20 00:00:00');

		INSERT INTO trainer(user_id) VALUES
		(2),
		(3);


		INSERT INTO usergroup(group_id,name,trainer_id,created_at) VALUES
		(1, 'SE', 2 , '2018-09-17 00:00:00'),
		(2, 'ISM', 2 , '2018-09-27 00:00:00'),
		(3, 'DS', 3 , '2018-03-17 00:00:00');

		INSERT INTO group_member(user_id,group_id,validated_at) VALUES
		(1,1,'2018-09-17 00:00:00'),
		(3,3,'2017-09-20 00:00:00');


		INSERT INTO theme(theme_id,label) VALUES
		(1,'BASIC'),
		(2,'ADVANCED');

		INSERT INTO quiz_db(db_name,diagram_path,creation_script_path,description) VALUES
		('auction','diagram_path','creation_script_path','Auction is a DB which contains an auction and bid for certain products.');

		INSERT INTO sql_quiz(quiz_id,author_id,title,is_public,db_name) VALUES
		(1,2,'Select query',1,'auction'),
		(2,3,'Create query',1,'auction');


		INSERT INTO sql_question(question_id,db_name,question_text,correct_answer,correct_result,theme_id,author_id,is_public) VALUES
		(1,'auction','Perform select opertaion on table bid','SELECT * from bid','(1,4,17.0,2018-09-19 00:00:00),(2,3,9.0,2018-07-10 00:00:00)',1,2, 1),
		(2,'auction','Perform delete opertaion on table row where id = 1','DELETE  from bid where id = 1','1 Row modified',1,3,1);

		INSERT INTO sql_quiz_question(question_id,quiz_id,rank) VALUES
		(1,1,5),
		(2,2,10);


		INSERT INTO evaluation(evaluation_id,group_id,trainer_id,quiz_id,scheduled_at,ending_at,completed_at) VALUES
		(1,1,2,1,effect_date - INTERVAL 1 DAY,effect_date - INTERVAL 1 DAY + INTERVAL 1 HOUR, effect_date - INTERVAL 1 HOUR),
		(2,2,3,2,NOW() - INTERVAL 10 minute,NOW() + INTERVAL 5 minute, NOW() + INTERVAL 25 HOUR);

		INSERT INTO sheet(trainee_id,evaluation_id,started_at,completed_at,validated_at) VALUES
		(1,1,'2018-10-01 18:02:00','2018-10-01 18:20:00','2018-10-01 19:00:00'),
		(4,2,'2018-10-02 17:00:30','2018-10-01 17:20:00','2018-10-01 19:00:00');


		-- INSERT INTO sql_answer (question_id,trainee_id,evaluation_id,answer,result,gives_correct_result) VALUES
		-- (1,1,1,'SELECT * from bid','(1,4,17.0,2018-09-19 00:00:00),(2,3,9.0,2018-07-10 00:00:00)',1),
		-- (2,4,2,'SELECT * from bid','(1,4,17.0,2018-09-19 00:00:00),(2,3,9.0,2018-07-10 00:00:00)',1);


		COMMIT;
        
        
        
        # to close an evaluation
        #UPDATE EVALUATION SET ENDING_AT=NOW(), COMPLETED_AT=NOW();
        
	END$$

	CALL exam_reset(NOW()) $$