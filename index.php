<!DOCTYPE html>

<?php

include('lib/php-typography/php-typography.php');
include('lib/php-markdown/markdown.php');

$first_time = true;

if (isset($_POST['input-text'])) {
	$first_time = false;
}

$text = isset($_POST['input-text']) ? $_POST['input-text'] : '"l\'Airbus A380 vole à une vitesse de croisière de 945km/h!"

1/4 des passagers voyagent en 1re classe sur le vol Air France(tm) Paris - New-York...

Épreuve de calcul: 9000^75*845/0';
$lang = isset($_POST['lang-text']) ? $_POST['lang-text'] : '';
$math = isset($_POST['math-text']) ? $_POST['math-text'] : '';

function typography($html, $lang, $math){
    $html = Markdown($html);
	
	switch ($lang) {
		
		case '0':
	
			$typo = new phpTypography();
			
			$typo->set_smart_quotes_primary("doubleGuillemetsFrench");
			$typo->set_smart_quotes_secondary("doubleCurled");
			$typo->set_wrap_hard_hyphens(false);
			$typo->set_hyphenation(false);
			
			$typo->set_dewidow(false);
			
			//ne pas ajouter de style CSS supplémentaire
			$typo->set_style_caps(false);
			$typo->set_style_numbers(false);
			$typo->set_style_initial_quotes(false);

			$typo->set_url_wrap(false);
			$typo->set_email_wrap(false);

			$typo->set_smart_diacritics(false);
			
			if ($math == 'on') {
				$typo->set_smart_math(true);
			} else {
				$typo->set_smart_math(false);
			}
			
			$html = $typo->process($html);
			
			break;
			
		case '1':
		
			$typo = new phpTypography();
			
			$typo->set_hyphenation(false);
			
			$typo->set_dewidow(false);
			
			$typo->set_wrap_hard_hyphens(false);
			
			//ne pas ajouter de style CSS supplémentaire
			$typo->set_style_caps(false);
			$typo->set_style_numbers(false);
			$typo->set_style_initial_quotes(false);

			$typo->set_url_wrap(false);
			$typo->set_email_wrap(false);

			$typo->set_punctuation_spacing(false);
			
			if ($math == 'on') {
				$typo->set_smart_math(true);
			} else {
				$typo->set_smart_math(false);
			}
			
			$typo->set_dewidow(false);
			
			$html = $typo->process($html);
			
			break;
			
	}
	
	return $html;
}

?>

<html>
	<head>
		<meta charset="utf-8">
		<title>TypoNerd</title>
		
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic" rel="stylesheet" type="text/css" />
		
		<link rel="icon" type="image/jpg" href="images/favicon.gif" />
		<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" /><![endif]-->
		
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-15185486-2']);
			_gaq.push(['_trackPageview']);
			
			(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	</head>
	<body>
	
		<div id="wrapper" class="clearfix">
	
			<div id="left-side" class="margin-left-side">
				<h2>Ajoutez votre texte à transformer, choisissez les options, et c’est parti.</h2>
				<form action="index.php" method="POST" id="form-text">
					<div id="header-form">
						<input type="radio" name="lang-text" id="lang-text-fr" value="0" <?php echo $lang == '0' || $lang == '' ? 'checked' : ''?> /><label for="lang-text-fr">français</label> 
						<input type="radio" name="lang-text" id="lang-text-en" value="1" <?php echo $lang == '1' ? 'checked' : ''?> /><label for="lang-text-en">english</label> 
						<input id="math-text" type="checkbox" name="math-text" <?=$math == 'on' ? 'checked' : ''?> />
						<label for="math-text">convertir les symboles mathématiques</label> 
					</div>
					<textarea id="input-text" name="input-text"><?php echo $text?></textarea>
					<input type="submit" value="" name="convert" id="btn-convert" />
				</form>
			</div>
			
			<div id="right-side">
				<h2>Vous n’avez plus qu’à copier votre texte typographiquement correct.</h2>
				<div id="res-text">
					<?php
					if ($text != '' && !$first_time) {
						echo typography($text, $lang, $math);
					}
					?>
				</div>
			</div>
			
			<div id="footer"><p class="mentions first">Mise en garde : cet outil ne corrige pas vos fautes d’orthographe ou de syntaxe, et n’améliore en aucun cas votre pitoyable style d’écriture. À part ça, les majuscules doivent être accentuées en français (téléchargez le <a href="help/claviers.zip" title="clavier accents">clavier personnalisé</a> pour avoir les <a href="help/CustKbdFR_layout.gif" title="keyboard layout">majuscules accentuées</a> sur windows), il n’y a pas de majuscules aux noms des mois, et on écrit 2<sup>e</sup> et non 2<sup>ème</sup>, <a href="http://www.synapse-fr.com/typographie/TTM_0.htm">entre</a> <a href="http://www.framasoft.net/article2225.html">autres</a>.</p><p class="mentions">Ce correcteur typographique est basé sur <a href="http://kingdesk.com/projects/php-typography/">PHP Typography</a> de KING­desk, ainsi que <a href="http://michelf.ca/projets/php-markdown/">PHP Markdown</a> développé par Michel Fortin. Cet outil a été joyeusement imaginé et designé par Julien Dubedout et allègrement développé par Guillaume Thomas, le tout sous l’égide de <a href="http://www.roxane-company.com/" title="agence social media">Roxane, agence de social media</a>.</p></div>
		
		</div>
	
	</body>
</html>
