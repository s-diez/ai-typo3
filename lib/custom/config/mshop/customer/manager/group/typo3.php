<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2016
 */

return array(
	'search' => array(
		'ansi' => '
			SELECT DISTINCT t3feg."uid" AS "customer.group.id", t3feg."title" AS "customer.group.code",
				t3feg."title" AS "customer.group.label", t3feg."crdate", t3feg."tstamp"
			FROM "fe_groups" AS t3feg
			:joins
			WHERE :cond
			/*-orderby*/ ORDER BY :order /*orderby-*/
			LIMIT :size OFFSET :start
		',
	),
	'count' => array(
		'ansi' => '
			SELECT COUNT(*) AS "count"
			FROM (
				SELECT DISTINCT t3feg."uid"
				FROM "fe_groups" AS t3feg
				:joins
				WHERE :cond
				LIMIT 10000 OFFSET 0
			) AS list
		',
	),
);