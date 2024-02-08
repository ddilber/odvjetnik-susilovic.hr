<?php
	$settings['imEmailForm_5_11'] = array(
		"owner_email_from" => "E-mail",
		"owner_email_to" => "ured@odvjetnik-susilovic.hr",
		"customer_email_from" => "ured@odvjetnik-susilovic.hr",
		"customer_email_to" => "",
		"owner_message" => "",
		"customer_message" => "",
		"owner_subject" => "Message",
		"customer_subject" => "",
		"owner_csv" => False,
		"customer_csv" => False,
		"confirmation_page" => "../index.html"
	);

	if(substr(basename($_SERVER['PHP_SELF']), 0, 11) == "imEmailForm") {
		include "../res/x5engine.php";

		$answers = array(
		);

		$form_data = array(
			"Name" => $_POST['imObjectForm_11_1'],
			"Surname" => $_POST['imObjectForm_11_2'],
			"E-mail" => $_POST['imObjectForm_11_3'],
			"Message" => $_POST['Message']
		);

		$files_data = array(
		);

		if(@$_POST['action'] != "check_answer") {
			if(!isset($_POST['imJsCheck']) || $_POST['imJsCheck'] != "jsactive")
				die(imPrintJsError());
			if (isset($_POST['imCpt']) && !isset($_POST['imCptHdn']))
				die(imPrintJsError());
			if(isset($_POST['imSpProt']) && $_POST['imSpProt'] != "")
				die(imPrintJsError());
			$email = new imSendEmail();
			$email->sendFormEmail($settings['imEmailForm_5_11'], $form_data, $files_data);
			@header('Location: ' . $settings['imEmailForm_5_11']['confirmation_page']);
		} else {
			if(@$_POST['id'] == "" || @$_POST['answer'] == "" || strtolower(trim($answers[@$_POST['id']])) != strtolower(trim(@$_POST['answer'])))
				echo "0";
			else
				echo "1";
		}
	}

// End of file