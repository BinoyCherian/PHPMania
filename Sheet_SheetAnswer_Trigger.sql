DELIMITER $$
DROP TRIGGER sheet_AFTER_INSERT$$
CREATE TRIGGER sheet_AFTER_INSERT 
AFTER INSERT ON `sheet`
FOR EACH ROW
BEGIN
	INSERT INTO sql_answer (question_id,trainee_id,evaluation_id,answer,result,gives_correct_result)
	SELECT question_id, NEW.trainee_id, NEW.evaluation_id, NULL, NULL, NULL
	FROM sql_question
	WHERE question_id IN
    (
		SELECT question_id
		FROM sql_quiz_question
        WHERE quiz_id IN
        (
			SELECT quiz_id
            FROM evaluation
            WHERE evaluation_id = NEW.evaluation_id
		)
	);
END$$