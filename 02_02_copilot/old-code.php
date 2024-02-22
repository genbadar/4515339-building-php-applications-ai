<?php 
/**
	1. Open the file
	2. Process it line by line
	3. create an HTML link list, sorted by date
**/

function validateDate($date, $format = 'm/d/Y') {
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) === $date;
}

function validateUrl($url) {
	return filter_var($url, FILTER_VALIDATE_URL);
}

$live_streams = '07/08/2021, Watch Me Work, https://youtu.be/iQSyf3okJZI
07/01/2021, Adding Gutenberg to a Live Site!, https://youtu.be/v5miIK8sLbE
06/23/2021, Project Management Automation, https://youtu.be/u8nwlzvfeDY
06/16/2021, How I Built Podcast Liftoff, https://youtu.be/irytcbuLnVg
06/09/2021, Build Something Live for June 9th, https://youtu.be/vVM_C7lSqZE
06/02/2021, Build Something Live for June 2nd, https://youtu.be/df729qvq1cw
05/26/2021, Checking out SavvyCal (First Impressions), https://youtu.be/UfncxEjV_7Y
05/22/2021, Joe Casabona is Live!, https://youtu.be/1wTzSzv0LVM
05/19/2021, Setting Up Newsletter Glue with Lesley Sim, https://youtu.be/DWpVWeSTjwo
05/12/2021, Adding Payments to WordPress (WP Simple Pay), https://youtu.be/aR-1TDP8e5g
05/07/2021, Watch Me Work, https://youtu.be/zAyS_cgC2H4
04/29/2021, Watch Me Work, https://youtu.be/6Q27P69OHDM
04/23/2021, Watch Me Work, https://youtu.be/uGAuq18aqKo
04/15/2021, Creating a New WordPress Theme from Scratch, https://youtu.be/ZzY-RMQSnJs
04/08/2021, Creating a New WordPress Theme from Scratch, https://youtu.be/7D3JR4_YUu4
03/26/2021, Watch Me Work!, https://youtu.be/oPU1LXKt8fM
03/19/2021, WordPress Full Site Editing,  https://youtu.be/EgP95wjyeEg
03/03,2021, Build Something Live for March 2nd: Watch Me Write a WordPress Plugin, https://youtu.be/JR9gcl3dSjo
02/24/2021, Watch Me Write a WordPress Plugin (Build Something Live for February  23), https://youtu.be/5uGi9uJMTK0
02/18/2021, Build Something Live for February  17: WordPress News + Watch Me Work, https://youtu.be/jwQKjDk-PhQ
02/11/2021, Build Something Live for February 10: WordPress 5.7, Elementor, and WandaVision, https://youtu.be/qhCWNU97VPU
02/04/2021/, Build Something Live (Testimonials, Mac Apps, Craft, Otter.ai, and WandaVision), https://youtu.be/Mfu9fTbrhAM
12/23/2020, Generating Leads While Stuck at Home, https://youtu.be/90za6ODYZEE
12/18/2020, State of the Word 2020 Reaction & Analysis, https://youtu.be/4g4oXmng9l4
11/19/2020, Post Op: Redesigning Casabona.org, https://youtu.be/lPDi4FQR7uo
11/12/2020, Live Stream: Creating a Members-Only Podcast with Castos, https://youtu.be/sFJ-BLe26h8
11/4/2020, Live Stream for Nov 4th: Redesigning Casabona.org, https://youtu.be/bBVjHM5i7-U';


$contents = explode("\n", $live_streams);
$html = '<ul>' . "\n\r";

foreach ($contents as $live) {
	$elements = explode(',', $live);
	if (count($elements) === 3) {
		$date = trim($elements[0]);
		$title = trim($elements[1]);
		$url = trim($elements[2]);

		if (validateDate($date) && validateUrl($url)) {
			$sanitizedTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
			$sanitizedUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
			$formattedDate = date('F j, Y', strtotime($date));
			$formattedTitle = ucfirst($sanitizedTitle);
			$html .= "\t<li>{$formattedDate}: <a href=\"{$sanitizedUrl}\" title=\"{$formattedTitle}\">{$formattedTitle}</a></li>\n";
		}
	}
}

$html .= '</ul>';

echo $html;