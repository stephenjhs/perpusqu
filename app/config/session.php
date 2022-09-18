<?php 

function setOldSession($value) {
	$_SESSION["old"] = [
		"value" => $value
	];
}

function setAlertSession($message, $type) {
	$_SESSION["alert"] = [
		"message" => $message,
		"type" => $type
	];
}

function setValidationSession($message) {
	$_SESSION["validation"] = [
		"message" => $message,
	];
}

function alertMessage() {
	if(isset($_SESSION["alert"])) {
		echo '
			<div class="alert alert-' . $_SESSION["alert"]["type"] . '">
			' . $_SESSION["alert"]["message"] . '
			</div>
		';
	}
    unset($_SESSION["alert"]);
}

function errorMessage($column) {
	if(isset($_SESSION["validation"])) {
		if(isset($_SESSION["validation"]["message"][$column])) {
			echo '
	              <div class="invalid-feedback mt-2">
	                 ' . $_SESSION["validation"]["message"][$column] . '
	              </div>
			';
		}
	}
}

function error($column) {
	if(isset($_SESSION["validation"])) {
		if(isset($_SESSION["validation"]["message"][$column])) return "is-invalid";
	}
}

function old($column, $defaultValue = "") {
	if(isset($_SESSION["old"])) {
		if(isset($_SESSION["old"]["value"][$column])) return $_SESSION["old"]["value"][$column];
	}
	if($defaultValue != "") {
		return $defaultValue;
	}
}