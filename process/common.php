<?php
	function cmp($a, $b) {
	    if ($a['counts'] == $b['counts']) {
	        return 0;
	    }
	    return ($a['counts'] > $b['counts']) ? -1 : 1;
	}

	function multiexplode($string) {
		$delimiters = array(",", ".", "|", ":", "'", "\"", "\\", "?", "<", ">", "(", ")", ";", "!", "+", "-", "=", "*", "[", "]", "{", "}");
		return explode(' ', str_replace($delimiters, ' ', $string));
	}

	function formatizeTime($time) {
		return date("F j, Y g:i a", strtotime($time));
	}

	function formatizeHashTags($questionContent) {
		$tmpVarForTags = preg_split('/(\r\n)|\n|\r/', $questionContent);
		$tmpTagsForSearch = array();
		$tmpTagsForReplace = array();
		foreach ($tmpVarForTags as $candidate) {
			$tmp = multiexplode($candidate);
			foreach ($tmp as $tmpBit) {
				if ($tmpBit != '' && $tmpBit[0] == '#') {
					array_push($tmpTagsForSearch, $tmpBit);
					array_push($tmpTagsForReplace, '<a href="filtered.php?hashtag='.substr($tmpBit, 1).'">'.$tmpBit.'</a>');
				}
			}
		}
		return str_replace($tmpTagsForSearch, $tmpTagsForReplace, $questionContent);
	}

	function displayError() {
		$error = array(
			'You\'re not even registered. So why don\'t you sign-up?',
			'The username you used already exists. Kindly try another.',
			'Your passwords don\'t match.',
			'Your input doesn\'t contain anything.',
			'There\'s something wrong with your internet connection.'
		);
		
		if (isset($_SESSION['error'])) {
			echo '<div class="error-box">'.$error[$_SESSION['error']].'</div>';
			unset($_SESSION['error']);
		}
	}
?>