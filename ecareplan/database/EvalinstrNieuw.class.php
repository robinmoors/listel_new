<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class EvalinstrNieuw extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='EvalinstrNieuw';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='evalinstr_nieuw';
	const SQL_INSERT='INSERT INTO `evalinstr_nieuw` (`id`,`uitvoerder_id`,`dd`,`mm`,`jjjj`,`v1_1`,`extra1_1`,`v1_2`,`extra1_2`,`v1_3`,`extra1_3`,`v1_4`,`extra1_4`,`v1_5`,`extra1_5`,`v1_6`,`extra1_6`,`v1_7`,`extra1_7`,`v1_8`,`extra1_8`,`v1_9`,`extra1_9`,`v1_10`,`extra1_10`,`v1_11`,`extra1_11`,`v1_12`,`extra1_12`,`v1_13`,`extra1_13`,`v1_14`,`extra1_14`,`v1_15`,`extra1_15`,`v1_16`,`extra1_16`,`v1_17`,`extra1_17`,`v1_18`,`extra1_18`,`v1_19`,`extra1_19`,`v1_20`,`extra1_20`,`v1_21`,`extra1_21`,`v1_22`,`extra1_22`,`v2_1`,`extra2_1`,`v2_2`,`extra2_2`,`v2_3`,`extra2_3`,`v2_4`,`extra2_4`,`v2_5`,`extra2_5`,`v2_6`,`extra2_6`,`v2_7`,`extra2_7`,`v2_8`,`extra2_8`,`v2_9`,`extra2_9`,`v2_10`,`extra2_10`,`v2_11`,`extra2_11`,`v3_1`,`extra3_1`,`v3_2`,`extra3_2`,`v3_3`,`extra3_3`,`v4_1`,`extra4_1`,`v4_2`,`extra4_2`,`v4_3`,`extra4_3`,`v4_4`,`extra4_4`,`v5_1`,`extra5_1`,`v5_2`,`extra5_2`,`v5_3`,`extra5_3`,`v5_4`,`extra5_4`,`v5_5`,`extra5_5`,`v5_6`,`extra5_6`,`v5_7`,`extra5_7`,`v6`,`v7`,`v8`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `evalinstr_nieuw` (`uitvoerder_id`,`dd`,`mm`,`jjjj`,`v1_1`,`extra1_1`,`v1_2`,`extra1_2`,`v1_3`,`extra1_3`,`v1_4`,`extra1_4`,`v1_5`,`extra1_5`,`v1_6`,`extra1_6`,`v1_7`,`extra1_7`,`v1_8`,`extra1_8`,`v1_9`,`extra1_9`,`v1_10`,`extra1_10`,`v1_11`,`extra1_11`,`v1_12`,`extra1_12`,`v1_13`,`extra1_13`,`v1_14`,`extra1_14`,`v1_15`,`extra1_15`,`v1_16`,`extra1_16`,`v1_17`,`extra1_17`,`v1_18`,`extra1_18`,`v1_19`,`extra1_19`,`v1_20`,`extra1_20`,`v1_21`,`extra1_21`,`v1_22`,`extra1_22`,`v2_1`,`extra2_1`,`v2_2`,`extra2_2`,`v2_3`,`extra2_3`,`v2_4`,`extra2_4`,`v2_5`,`extra2_5`,`v2_6`,`extra2_6`,`v2_7`,`extra2_7`,`v2_8`,`extra2_8`,`v2_9`,`extra2_9`,`v2_10`,`extra2_10`,`v2_11`,`extra2_11`,`v3_1`,`extra3_1`,`v3_2`,`extra3_2`,`v3_3`,`extra3_3`,`v4_1`,`extra4_1`,`v4_2`,`extra4_2`,`v4_3`,`extra4_3`,`v4_4`,`extra4_4`,`v5_1`,`extra5_1`,`v5_2`,`extra5_2`,`v5_3`,`extra5_3`,`v5_4`,`extra5_4`,`v5_5`,`extra5_5`,`v5_6`,`extra5_6`,`v5_7`,`extra5_7`,`v6`,`v7`,`v8`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `evalinstr_nieuw` SET `id`=?,`uitvoerder_id`=?,`dd`=?,`mm`=?,`jjjj`=?,`v1_1`=?,`extra1_1`=?,`v1_2`=?,`extra1_2`=?,`v1_3`=?,`extra1_3`=?,`v1_4`=?,`extra1_4`=?,`v1_5`=?,`extra1_5`=?,`v1_6`=?,`extra1_6`=?,`v1_7`=?,`extra1_7`=?,`v1_8`=?,`extra1_8`=?,`v1_9`=?,`extra1_9`=?,`v1_10`=?,`extra1_10`=?,`v1_11`=?,`extra1_11`=?,`v1_12`=?,`extra1_12`=?,`v1_13`=?,`extra1_13`=?,`v1_14`=?,`extra1_14`=?,`v1_15`=?,`extra1_15`=?,`v1_16`=?,`extra1_16`=?,`v1_17`=?,`extra1_17`=?,`v1_18`=?,`extra1_18`=?,`v1_19`=?,`extra1_19`=?,`v1_20`=?,`extra1_20`=?,`v1_21`=?,`extra1_21`=?,`v1_22`=?,`extra1_22`=?,`v2_1`=?,`extra2_1`=?,`v2_2`=?,`extra2_2`=?,`v2_3`=?,`extra2_3`=?,`v2_4`=?,`extra2_4`=?,`v2_5`=?,`extra2_5`=?,`v2_6`=?,`extra2_6`=?,`v2_7`=?,`extra2_7`=?,`v2_8`=?,`extra2_8`=?,`v2_9`=?,`extra2_9`=?,`v2_10`=?,`extra2_10`=?,`v2_11`=?,`extra2_11`=?,`v3_1`=?,`extra3_1`=?,`v3_2`=?,`extra3_2`=?,`v3_3`=?,`extra3_3`=?,`v4_1`=?,`extra4_1`=?,`v4_2`=?,`extra4_2`=?,`v4_3`=?,`extra4_3`=?,`v4_4`=?,`extra4_4`=?,`v5_1`=?,`extra5_1`=?,`v5_2`=?,`extra5_2`=?,`v5_3`=?,`extra5_3`=?,`v5_4`=?,`extra5_4`=?,`v5_5`=?,`extra5_5`=?,`v5_6`=?,`extra5_6`=?,`v5_7`=?,`extra5_7`=?,`v6`=?,`v7`=?,`v8`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `evalinstr_nieuw` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `evalinstr_nieuw` WHERE `id`=?';
	const FIELD_ID=-5413972;
	const FIELD_UITVOERDER_ID=722200030;
	const FIELD_DD=-5414127;
	const FIELD_MM=-5413839;
	const FIELD_JJJJ=-907820847;
	const FIELD_V1_1=-907518530;
	const FIELD_EXTRA1_1=-1402709148;
	const FIELD_V1_2=-907518529;
	const FIELD_EXTRA1_2=-1402709147;
	const FIELD_V1_3=-907518528;
	const FIELD_EXTRA1_3=-1402709146;
	const FIELD_V1_4=-907518527;
	const FIELD_EXTRA1_4=-1402709145;
	const FIELD_V1_5=-907518526;
	const FIELD_EXTRA1_5=-1402709144;
	const FIELD_V1_6=-907518525;
	const FIELD_EXTRA1_6=-1402709143;
	const FIELD_V1_7=-907518524;
	const FIELD_EXTRA1_7=-1402709142;
	const FIELD_V1_8=-907518523;
	const FIELD_EXTRA1_8=-1402709141;
	const FIELD_V1_9=-907518522;
	const FIELD_EXTRA1_9=-1402709140;
	const FIELD_V1_10=1931696690;
	const FIELD_EXTRA1_10=-534310580;
	const FIELD_V1_11=1931696691;
	const FIELD_EXTRA1_11=-534310579;
	const FIELD_V1_12=1931696692;
	const FIELD_EXTRA1_12=-534310578;
	const FIELD_V1_13=1931696693;
	const FIELD_EXTRA1_13=-534310577;
	const FIELD_V1_14=1931696694;
	const FIELD_EXTRA1_14=-534310576;
	const FIELD_V1_15=1931696695;
	const FIELD_EXTRA1_15=-534310575;
	const FIELD_V1_16=1931696696;
	const FIELD_EXTRA1_16=-534310574;
	const FIELD_V1_17=1931696697;
	const FIELD_EXTRA1_17=-534310573;
	const FIELD_V1_18=1931696698;
	const FIELD_EXTRA1_18=-534310572;
	const FIELD_V1_19=1931696699;
	const FIELD_EXTRA1_19=-534310571;
	const FIELD_V1_20=1931696721;
	const FIELD_EXTRA1_20=-534310549;
	const FIELD_V1_21=1931696722;
	const FIELD_EXTRA1_21=-534310548;
	const FIELD_V1_22=1931696723;
	const FIELD_EXTRA1_22=-534310547;
	const FIELD_V2_1=-907517569;
	const FIELD_EXTRA2_1=-1402708187;
	const FIELD_V2_2=-907517568;
	const FIELD_EXTRA2_2=-1402708186;
	const FIELD_V2_3=-907517567;
	const FIELD_EXTRA2_3=-1402708185;
	const FIELD_V2_4=-907517566;
	const FIELD_EXTRA2_4=-1402708184;
	const FIELD_V2_5=-907517565;
	const FIELD_EXTRA2_5=-1402708183;
	const FIELD_V2_6=-907517564;
	const FIELD_EXTRA2_6=-1402708182;
	const FIELD_V2_7=-907517563;
	const FIELD_EXTRA2_7=-1402708181;
	const FIELD_V2_8=-907517562;
	const FIELD_EXTRA2_8=-1402708180;
	const FIELD_V2_9=-907517561;
	const FIELD_EXTRA2_9=-1402708179;
	const FIELD_V2_10=1931726481;
	const FIELD_EXTRA2_10=-534280789;
	const FIELD_V2_11=1931726482;
	const FIELD_EXTRA2_11=-534280788;
	const FIELD_V3_1=-907516608;
	const FIELD_EXTRA3_1=-1402707226;
	const FIELD_V3_2=-907516607;
	const FIELD_EXTRA3_2=-1402707225;
	const FIELD_V3_3=-907516606;
	const FIELD_EXTRA3_3=-1402707224;
	const FIELD_V4_1=-907515647;
	const FIELD_EXTRA4_1=-1402706265;
	const FIELD_V4_2=-907515646;
	const FIELD_EXTRA4_2=-1402706264;
	const FIELD_V4_3=-907515645;
	const FIELD_EXTRA4_3=-1402706263;
	const FIELD_V4_4=-907515644;
	const FIELD_EXTRA4_4=-1402706262;
	const FIELD_V5_1=-907514686;
	const FIELD_EXTRA5_1=-1402705304;
	const FIELD_V5_2=-907514685;
	const FIELD_EXTRA5_2=-1402705303;
	const FIELD_V5_3=-907514684;
	const FIELD_EXTRA5_3=-1402705302;
	const FIELD_V5_4=-907514683;
	const FIELD_EXTRA5_4=-1402705301;
	const FIELD_V5_5=-907514682;
	const FIELD_EXTRA5_5=-1402705300;
	const FIELD_V5_6=-907514681;
	const FIELD_EXTRA5_6=-1402705299;
	const FIELD_V5_7=-907514680;
	const FIELD_EXTRA5_7=-1402705298;
	const FIELD_V6=-5413615;
	const FIELD_V7=-5413614;
	const FIELD_V8=-5413613;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_UITVOERDER_ID=>'uitvoerder_id',
		self::FIELD_DD=>'dd',
		self::FIELD_MM=>'mm',
		self::FIELD_JJJJ=>'jjjj',
		self::FIELD_V1_1=>'v1_1',
		self::FIELD_EXTRA1_1=>'extra1_1',
		self::FIELD_V1_2=>'v1_2',
		self::FIELD_EXTRA1_2=>'extra1_2',
		self::FIELD_V1_3=>'v1_3',
		self::FIELD_EXTRA1_3=>'extra1_3',
		self::FIELD_V1_4=>'v1_4',
		self::FIELD_EXTRA1_4=>'extra1_4',
		self::FIELD_V1_5=>'v1_5',
		self::FIELD_EXTRA1_5=>'extra1_5',
		self::FIELD_V1_6=>'v1_6',
		self::FIELD_EXTRA1_6=>'extra1_6',
		self::FIELD_V1_7=>'v1_7',
		self::FIELD_EXTRA1_7=>'extra1_7',
		self::FIELD_V1_8=>'v1_8',
		self::FIELD_EXTRA1_8=>'extra1_8',
		self::FIELD_V1_9=>'v1_9',
		self::FIELD_EXTRA1_9=>'extra1_9',
		self::FIELD_V1_10=>'v1_10',
		self::FIELD_EXTRA1_10=>'extra1_10',
		self::FIELD_V1_11=>'v1_11',
		self::FIELD_EXTRA1_11=>'extra1_11',
		self::FIELD_V1_12=>'v1_12',
		self::FIELD_EXTRA1_12=>'extra1_12',
		self::FIELD_V1_13=>'v1_13',
		self::FIELD_EXTRA1_13=>'extra1_13',
		self::FIELD_V1_14=>'v1_14',
		self::FIELD_EXTRA1_14=>'extra1_14',
		self::FIELD_V1_15=>'v1_15',
		self::FIELD_EXTRA1_15=>'extra1_15',
		self::FIELD_V1_16=>'v1_16',
		self::FIELD_EXTRA1_16=>'extra1_16',
		self::FIELD_V1_17=>'v1_17',
		self::FIELD_EXTRA1_17=>'extra1_17',
		self::FIELD_V1_18=>'v1_18',
		self::FIELD_EXTRA1_18=>'extra1_18',
		self::FIELD_V1_19=>'v1_19',
		self::FIELD_EXTRA1_19=>'extra1_19',
		self::FIELD_V1_20=>'v1_20',
		self::FIELD_EXTRA1_20=>'extra1_20',
		self::FIELD_V1_21=>'v1_21',
		self::FIELD_EXTRA1_21=>'extra1_21',
		self::FIELD_V1_22=>'v1_22',
		self::FIELD_EXTRA1_22=>'extra1_22',
		self::FIELD_V2_1=>'v2_1',
		self::FIELD_EXTRA2_1=>'extra2_1',
		self::FIELD_V2_2=>'v2_2',
		self::FIELD_EXTRA2_2=>'extra2_2',
		self::FIELD_V2_3=>'v2_3',
		self::FIELD_EXTRA2_3=>'extra2_3',
		self::FIELD_V2_4=>'v2_4',
		self::FIELD_EXTRA2_4=>'extra2_4',
		self::FIELD_V2_5=>'v2_5',
		self::FIELD_EXTRA2_5=>'extra2_5',
		self::FIELD_V2_6=>'v2_6',
		self::FIELD_EXTRA2_6=>'extra2_6',
		self::FIELD_V2_7=>'v2_7',
		self::FIELD_EXTRA2_7=>'extra2_7',
		self::FIELD_V2_8=>'v2_8',
		self::FIELD_EXTRA2_8=>'extra2_8',
		self::FIELD_V2_9=>'v2_9',
		self::FIELD_EXTRA2_9=>'extra2_9',
		self::FIELD_V2_10=>'v2_10',
		self::FIELD_EXTRA2_10=>'extra2_10',
		self::FIELD_V2_11=>'v2_11',
		self::FIELD_EXTRA2_11=>'extra2_11',
		self::FIELD_V3_1=>'v3_1',
		self::FIELD_EXTRA3_1=>'extra3_1',
		self::FIELD_V3_2=>'v3_2',
		self::FIELD_EXTRA3_2=>'extra3_2',
		self::FIELD_V3_3=>'v3_3',
		self::FIELD_EXTRA3_3=>'extra3_3',
		self::FIELD_V4_1=>'v4_1',
		self::FIELD_EXTRA4_1=>'extra4_1',
		self::FIELD_V4_2=>'v4_2',
		self::FIELD_EXTRA4_2=>'extra4_2',
		self::FIELD_V4_3=>'v4_3',
		self::FIELD_EXTRA4_3=>'extra4_3',
		self::FIELD_V4_4=>'v4_4',
		self::FIELD_EXTRA4_4=>'extra4_4',
		self::FIELD_V5_1=>'v5_1',
		self::FIELD_EXTRA5_1=>'extra5_1',
		self::FIELD_V5_2=>'v5_2',
		self::FIELD_EXTRA5_2=>'extra5_2',
		self::FIELD_V5_3=>'v5_3',
		self::FIELD_EXTRA5_3=>'extra5_3',
		self::FIELD_V5_4=>'v5_4',
		self::FIELD_EXTRA5_4=>'extra5_4',
		self::FIELD_V5_5=>'v5_5',
		self::FIELD_EXTRA5_5=>'extra5_5',
		self::FIELD_V5_6=>'v5_6',
		self::FIELD_EXTRA5_6=>'extra5_6',
		self::FIELD_V5_7=>'v5_7',
		self::FIELD_EXTRA5_7=>'extra5_7',
		self::FIELD_V6=>'v6',
		self::FIELD_V7=>'v7',
		self::FIELD_V8=>'v8');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_UITVOERDER_ID=>'uitvoerderId',
		self::FIELD_DD=>'dd',
		self::FIELD_MM=>'mm',
		self::FIELD_JJJJ=>'jjjj',
		self::FIELD_V1_1=>'v11',
		self::FIELD_EXTRA1_1=>'extra11',
		self::FIELD_V1_2=>'v12',
		self::FIELD_EXTRA1_2=>'extra12',
		self::FIELD_V1_3=>'v13',
		self::FIELD_EXTRA1_3=>'extra13',
		self::FIELD_V1_4=>'v14',
		self::FIELD_EXTRA1_4=>'extra14',
		self::FIELD_V1_5=>'v15',
		self::FIELD_EXTRA1_5=>'extra15',
		self::FIELD_V1_6=>'v16',
		self::FIELD_EXTRA1_6=>'extra16',
		self::FIELD_V1_7=>'v17',
		self::FIELD_EXTRA1_7=>'extra17',
		self::FIELD_V1_8=>'v18',
		self::FIELD_EXTRA1_8=>'extra18',
		self::FIELD_V1_9=>'v19',
		self::FIELD_EXTRA1_9=>'extra19',
		self::FIELD_V1_10=>'v110',
		self::FIELD_EXTRA1_10=>'extra110',
		self::FIELD_V1_11=>'v111',
		self::FIELD_EXTRA1_11=>'extra111',
		self::FIELD_V1_12=>'v112',
		self::FIELD_EXTRA1_12=>'extra112',
		self::FIELD_V1_13=>'v113',
		self::FIELD_EXTRA1_13=>'extra113',
		self::FIELD_V1_14=>'v114',
		self::FIELD_EXTRA1_14=>'extra114',
		self::FIELD_V1_15=>'v115',
		self::FIELD_EXTRA1_15=>'extra115',
		self::FIELD_V1_16=>'v116',
		self::FIELD_EXTRA1_16=>'extra116',
		self::FIELD_V1_17=>'v117',
		self::FIELD_EXTRA1_17=>'extra117',
		self::FIELD_V1_18=>'v118',
		self::FIELD_EXTRA1_18=>'extra118',
		self::FIELD_V1_19=>'v119',
		self::FIELD_EXTRA1_19=>'extra119',
		self::FIELD_V1_20=>'v120',
		self::FIELD_EXTRA1_20=>'extra120',
		self::FIELD_V1_21=>'v121',
		self::FIELD_EXTRA1_21=>'extra121',
		self::FIELD_V1_22=>'v122',
		self::FIELD_EXTRA1_22=>'extra122',
		self::FIELD_V2_1=>'v21',
		self::FIELD_EXTRA2_1=>'extra21',
		self::FIELD_V2_2=>'v22',
		self::FIELD_EXTRA2_2=>'extra22',
		self::FIELD_V2_3=>'v23',
		self::FIELD_EXTRA2_3=>'extra23',
		self::FIELD_V2_4=>'v24',
		self::FIELD_EXTRA2_4=>'extra24',
		self::FIELD_V2_5=>'v25',
		self::FIELD_EXTRA2_5=>'extra25',
		self::FIELD_V2_6=>'v26',
		self::FIELD_EXTRA2_6=>'extra26',
		self::FIELD_V2_7=>'v27',
		self::FIELD_EXTRA2_7=>'extra27',
		self::FIELD_V2_8=>'v28',
		self::FIELD_EXTRA2_8=>'extra28',
		self::FIELD_V2_9=>'v29',
		self::FIELD_EXTRA2_9=>'extra29',
		self::FIELD_V2_10=>'v210',
		self::FIELD_EXTRA2_10=>'extra210',
		self::FIELD_V2_11=>'v211',
		self::FIELD_EXTRA2_11=>'extra211',
		self::FIELD_V3_1=>'v31',
		self::FIELD_EXTRA3_1=>'extra31',
		self::FIELD_V3_2=>'v32',
		self::FIELD_EXTRA3_2=>'extra32',
		self::FIELD_V3_3=>'v33',
		self::FIELD_EXTRA3_3=>'extra33',
		self::FIELD_V4_1=>'v41',
		self::FIELD_EXTRA4_1=>'extra41',
		self::FIELD_V4_2=>'v42',
		self::FIELD_EXTRA4_2=>'extra42',
		self::FIELD_V4_3=>'v43',
		self::FIELD_EXTRA4_3=>'extra43',
		self::FIELD_V4_4=>'v44',
		self::FIELD_EXTRA4_4=>'extra44',
		self::FIELD_V5_1=>'v51',
		self::FIELD_EXTRA5_1=>'extra51',
		self::FIELD_V5_2=>'v52',
		self::FIELD_EXTRA5_2=>'extra52',
		self::FIELD_V5_3=>'v53',
		self::FIELD_EXTRA5_3=>'extra53',
		self::FIELD_V5_4=>'v54',
		self::FIELD_EXTRA5_4=>'extra54',
		self::FIELD_V5_5=>'v55',
		self::FIELD_EXTRA5_5=>'extra55',
		self::FIELD_V5_6=>'v56',
		self::FIELD_EXTRA5_6=>'extra56',
		self::FIELD_V5_7=>'v57',
		self::FIELD_EXTRA5_7=>'extra57',
		self::FIELD_V6=>'v6',
		self::FIELD_V7=>'v7',
		self::FIELD_V8=>'v8');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_UITVOERDER_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_JJJJ=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_V1_1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_2=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_2=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_3=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_3=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_4=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_4=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_5=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_5=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_6=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_6=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_7=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_7=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_8=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_8=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_9=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_9=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_10=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_10=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_11=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_11=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_12=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_12=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_13=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_13=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_14=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_14=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_15=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_15=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_16=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_16=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_17=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_17=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_18=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_18=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_19=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_19=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_20=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_20=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_21=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_21=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V1_22=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA1_22=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_2=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_2=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_3=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_3=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_4=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_4=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_5=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_5=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_6=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_6=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_7=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_7=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_8=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_8=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_9=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_9=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_10=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_10=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V2_11=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA2_11=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V3_1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA3_1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V3_2=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA3_2=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V3_3=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA3_3=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V4_1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA4_1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V4_2=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA4_2=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V4_3=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA4_3=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V4_4=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA4_4=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V5_1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA5_1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V5_2=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA5_2=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V5_3=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA5_3=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V5_4=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA5_4=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V5_5=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA5_5=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V5_6=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA5_6=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V5_7=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EXTRA5_7=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V6=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V7=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_V8=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_UITVOERDER_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_DD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_JJJJ=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_V1_1=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_1=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_2=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_2=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_3=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_3=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_4=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_4=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_5=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_5=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_6=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_6=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_7=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_7=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_8=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_8=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_9=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_9=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_10=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_10=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_11=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_11=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_12=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_12=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_13=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_13=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_14=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_14=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_15=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_15=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_16=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_16=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_17=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_17=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_18=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_18=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_19=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_19=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_20=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_20=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_21=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_21=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V1_22=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA1_22=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_1=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_1=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_2=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_2=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_3=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_3=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_4=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_4=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_5=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_5=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_6=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_6=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_7=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_7=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_8=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_8=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_9=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_9=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_10=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_10=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V2_11=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA2_11=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V3_1=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA3_1=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V3_2=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA3_2=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V3_3=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA3_3=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V4_1=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA4_1=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V4_2=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA4_2=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V4_3=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA4_3=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V4_4=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA4_4=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V5_1=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA5_1=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V5_2=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA5_2=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V5_3=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA5_3=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V5_4=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA5_4=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V5_5=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA5_5=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V5_6=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA5_6=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V5_7=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_EXTRA5_7=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_V6=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_V7=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_V8=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_UITVOERDER_ID=>0,
		self::FIELD_DD=>0,
		self::FIELD_MM=>0,
		self::FIELD_JJJJ=>0,
		self::FIELD_V1_1=>0,
		self::FIELD_EXTRA1_1=>null,
		self::FIELD_V1_2=>0,
		self::FIELD_EXTRA1_2=>null,
		self::FIELD_V1_3=>0,
		self::FIELD_EXTRA1_3=>null,
		self::FIELD_V1_4=>0,
		self::FIELD_EXTRA1_4=>null,
		self::FIELD_V1_5=>0,
		self::FIELD_EXTRA1_5=>null,
		self::FIELD_V1_6=>0,
		self::FIELD_EXTRA1_6=>null,
		self::FIELD_V1_7=>0,
		self::FIELD_EXTRA1_7=>null,
		self::FIELD_V1_8=>0,
		self::FIELD_EXTRA1_8=>null,
		self::FIELD_V1_9=>0,
		self::FIELD_EXTRA1_9=>null,
		self::FIELD_V1_10=>0,
		self::FIELD_EXTRA1_10=>null,
		self::FIELD_V1_11=>0,
		self::FIELD_EXTRA1_11=>null,
		self::FIELD_V1_12=>0,
		self::FIELD_EXTRA1_12=>null,
		self::FIELD_V1_13=>0,
		self::FIELD_EXTRA1_13=>null,
		self::FIELD_V1_14=>0,
		self::FIELD_EXTRA1_14=>null,
		self::FIELD_V1_15=>0,
		self::FIELD_EXTRA1_15=>null,
		self::FIELD_V1_16=>0,
		self::FIELD_EXTRA1_16=>null,
		self::FIELD_V1_17=>0,
		self::FIELD_EXTRA1_17=>null,
		self::FIELD_V1_18=>0,
		self::FIELD_EXTRA1_18=>null,
		self::FIELD_V1_19=>0,
		self::FIELD_EXTRA1_19=>null,
		self::FIELD_V1_20=>0,
		self::FIELD_EXTRA1_20=>null,
		self::FIELD_V1_21=>0,
		self::FIELD_EXTRA1_21=>null,
		self::FIELD_V1_22=>0,
		self::FIELD_EXTRA1_22=>null,
		self::FIELD_V2_1=>0,
		self::FIELD_EXTRA2_1=>null,
		self::FIELD_V2_2=>0,
		self::FIELD_EXTRA2_2=>null,
		self::FIELD_V2_3=>0,
		self::FIELD_EXTRA2_3=>null,
		self::FIELD_V2_4=>0,
		self::FIELD_EXTRA2_4=>null,
		self::FIELD_V2_5=>0,
		self::FIELD_EXTRA2_5=>null,
		self::FIELD_V2_6=>0,
		self::FIELD_EXTRA2_6=>null,
		self::FIELD_V2_7=>0,
		self::FIELD_EXTRA2_7=>null,
		self::FIELD_V2_8=>0,
		self::FIELD_EXTRA2_8=>null,
		self::FIELD_V2_9=>0,
		self::FIELD_EXTRA2_9=>null,
		self::FIELD_V2_10=>0,
		self::FIELD_EXTRA2_10=>null,
		self::FIELD_V2_11=>0,
		self::FIELD_EXTRA2_11=>null,
		self::FIELD_V3_1=>0,
		self::FIELD_EXTRA3_1=>null,
		self::FIELD_V3_2=>0,
		self::FIELD_EXTRA3_2=>null,
		self::FIELD_V3_3=>0,
		self::FIELD_EXTRA3_3=>null,
		self::FIELD_V4_1=>0,
		self::FIELD_EXTRA4_1=>null,
		self::FIELD_V4_2=>0,
		self::FIELD_EXTRA4_2=>null,
		self::FIELD_V4_3=>0,
		self::FIELD_EXTRA4_3=>null,
		self::FIELD_V4_4=>0,
		self::FIELD_EXTRA4_4=>null,
		self::FIELD_V5_1=>0,
		self::FIELD_EXTRA5_1=>null,
		self::FIELD_V5_2=>0,
		self::FIELD_EXTRA5_2=>null,
		self::FIELD_V5_3=>0,
		self::FIELD_EXTRA5_3=>null,
		self::FIELD_V5_4=>0,
		self::FIELD_EXTRA5_4=>null,
		self::FIELD_V5_5=>0,
		self::FIELD_EXTRA5_5=>null,
		self::FIELD_V5_6=>0,
		self::FIELD_EXTRA5_6=>null,
		self::FIELD_V5_7=>0,
		self::FIELD_EXTRA5_7=>null,
		self::FIELD_V6=>null,
		self::FIELD_V7=>null,
		self::FIELD_V8=>null);
	private $id;
	private $uitvoerderId;
	private $dd;
	private $mm;
	private $jjjj;
	private $v11;
	private $extra11;
	private $v12;
	private $extra12;
	private $v13;
	private $extra13;
	private $v14;
	private $extra14;
	private $v15;
	private $extra15;
	private $v16;
	private $extra16;
	private $v17;
	private $extra17;
	private $v18;
	private $extra18;
	private $v19;
	private $extra19;
	private $v110;
	private $extra110;
	private $v111;
	private $extra111;
	private $v112;
	private $extra112;
	private $v113;
	private $extra113;
	private $v114;
	private $extra114;
	private $v115;
	private $extra115;
	private $v116;
	private $extra116;
	private $v117;
	private $extra117;
	private $v118;
	private $extra118;
	private $v119;
	private $extra119;
	private $v120;
	private $extra120;
	private $v121;
	private $extra121;
	private $v122;
	private $extra122;
	private $v21;
	private $extra21;
	private $v22;
	private $extra22;
	private $v23;
	private $extra23;
	private $v24;
	private $extra24;
	private $v25;
	private $extra25;
	private $v26;
	private $extra26;
	private $v27;
	private $extra27;
	private $v28;
	private $extra28;
	private $v29;
	private $extra29;
	private $v210;
	private $extra210;
	private $v211;
	private $extra211;
	private $v31;
	private $extra31;
	private $v32;
	private $extra32;
	private $v33;
	private $extra33;
	private $v41;
	private $extra41;
	private $v42;
	private $extra42;
	private $v43;
	private $extra43;
	private $v44;
	private $extra44;
	private $v51;
	private $extra51;
	private $v52;
	private $extra52;
	private $v53;
	private $extra53;
	private $v54;
	private $extra54;
	private $v55;
	private $extra55;
	private $v56;
	private $extra56;
	private $v57;
	private $extra57;
	private $v6;
	private $v7;
	private $v8;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return EvalinstrNieuw
	 */
	public function &setId($id) {
		$this->notifyChanged(self::FIELD_ID,$this->id,$id);
		$this->id=$id;
		return $this;
	}

	/**
	 * get value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * set value for uitvoerder_id 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $uitvoerderId
	 * @return EvalinstrNieuw
	 */
	public function &setUitvoerderId($uitvoerderId) {
		$this->notifyChanged(self::FIELD_UITVOERDER_ID,$this->uitvoerderId,$uitvoerderId);
		$this->uitvoerderId=$uitvoerderId;
		return $this;
	}

	/**
	 * get value for uitvoerder_id 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getUitvoerderId() {
		return $this->uitvoerderId;
	}

	/**
	 * set value for dd 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $dd
	 * @return EvalinstrNieuw
	 */
	public function &setDd($dd) {
		$this->notifyChanged(self::FIELD_DD,$this->dd,$dd);
		$this->dd=$dd;
		return $this;
	}

	/**
	 * get value for dd 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getDd() {
		return $this->dd;
	}

	/**
	 * set value for mm 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $mm
	 * @return EvalinstrNieuw
	 */
	public function &setMm($mm) {
		$this->notifyChanged(self::FIELD_MM,$this->mm,$mm);
		$this->mm=$mm;
		return $this;
	}

	/**
	 * get value for mm 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getMm() {
		return $this->mm;
	}

	/**
	 * set value for jjjj 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $jjjj
	 * @return EvalinstrNieuw
	 */
	public function &setJjjj($jjjj) {
		$this->notifyChanged(self::FIELD_JJJJ,$this->jjjj,$jjjj);
		$this->jjjj=$jjjj;
		return $this;
	}

	/**
	 * get value for jjjj 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getJjjj() {
		return $this->jjjj;
	}

	/**
	 * set value for v1_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v11
	 * @return EvalinstrNieuw
	 */
	public function &setV11($v11) {
		$this->notifyChanged(self::FIELD_V1_1,$this->v11,$v11);
		$this->v11=$v11;
		return $this;
	}

	/**
	 * get value for v1_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV11() {
		return $this->v11;
	}

	/**
	 * set value for extra1_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra11
	 * @return EvalinstrNieuw
	 */
	public function &setExtra11($extra11) {
		$this->notifyChanged(self::FIELD_EXTRA1_1,$this->extra11,$extra11);
		$this->extra11=$extra11;
		return $this;
	}

	/**
	 * get value for extra1_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra11() {
		return $this->extra11;
	}

	/**
	 * set value for v1_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v12
	 * @return EvalinstrNieuw
	 */
	public function &setV12($v12) {
		$this->notifyChanged(self::FIELD_V1_2,$this->v12,$v12);
		$this->v12=$v12;
		return $this;
	}

	/**
	 * get value for v1_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV12() {
		return $this->v12;
	}

	/**
	 * set value for extra1_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra12
	 * @return EvalinstrNieuw
	 */
	public function &setExtra12($extra12) {
		$this->notifyChanged(self::FIELD_EXTRA1_2,$this->extra12,$extra12);
		$this->extra12=$extra12;
		return $this;
	}

	/**
	 * get value for extra1_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra12() {
		return $this->extra12;
	}

	/**
	 * set value for v1_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v13
	 * @return EvalinstrNieuw
	 */
	public function &setV13($v13) {
		$this->notifyChanged(self::FIELD_V1_3,$this->v13,$v13);
		$this->v13=$v13;
		return $this;
	}

	/**
	 * get value for v1_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV13() {
		return $this->v13;
	}

	/**
	 * set value for extra1_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra13
	 * @return EvalinstrNieuw
	 */
	public function &setExtra13($extra13) {
		$this->notifyChanged(self::FIELD_EXTRA1_3,$this->extra13,$extra13);
		$this->extra13=$extra13;
		return $this;
	}

	/**
	 * get value for extra1_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra13() {
		return $this->extra13;
	}

	/**
	 * set value for v1_4 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v14
	 * @return EvalinstrNieuw
	 */
	public function &setV14($v14) {
		$this->notifyChanged(self::FIELD_V1_4,$this->v14,$v14);
		$this->v14=$v14;
		return $this;
	}

	/**
	 * get value for v1_4 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV14() {
		return $this->v14;
	}

	/**
	 * set value for extra1_4 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra14
	 * @return EvalinstrNieuw
	 */
	public function &setExtra14($extra14) {
		$this->notifyChanged(self::FIELD_EXTRA1_4,$this->extra14,$extra14);
		$this->extra14=$extra14;
		return $this;
	}

	/**
	 * get value for extra1_4 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra14() {
		return $this->extra14;
	}

	/**
	 * set value for v1_5 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v15
	 * @return EvalinstrNieuw
	 */
	public function &setV15($v15) {
		$this->notifyChanged(self::FIELD_V1_5,$this->v15,$v15);
		$this->v15=$v15;
		return $this;
	}

	/**
	 * get value for v1_5 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV15() {
		return $this->v15;
	}

	/**
	 * set value for extra1_5 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra15
	 * @return EvalinstrNieuw
	 */
	public function &setExtra15($extra15) {
		$this->notifyChanged(self::FIELD_EXTRA1_5,$this->extra15,$extra15);
		$this->extra15=$extra15;
		return $this;
	}

	/**
	 * get value for extra1_5 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra15() {
		return $this->extra15;
	}

	/**
	 * set value for v1_6 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v16
	 * @return EvalinstrNieuw
	 */
	public function &setV16($v16) {
		$this->notifyChanged(self::FIELD_V1_6,$this->v16,$v16);
		$this->v16=$v16;
		return $this;
	}

	/**
	 * get value for v1_6 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV16() {
		return $this->v16;
	}

	/**
	 * set value for extra1_6 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra16
	 * @return EvalinstrNieuw
	 */
	public function &setExtra16($extra16) {
		$this->notifyChanged(self::FIELD_EXTRA1_6,$this->extra16,$extra16);
		$this->extra16=$extra16;
		return $this;
	}

	/**
	 * get value for extra1_6 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra16() {
		return $this->extra16;
	}

	/**
	 * set value for v1_7 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v17
	 * @return EvalinstrNieuw
	 */
	public function &setV17($v17) {
		$this->notifyChanged(self::FIELD_V1_7,$this->v17,$v17);
		$this->v17=$v17;
		return $this;
	}

	/**
	 * get value for v1_7 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV17() {
		return $this->v17;
	}

	/**
	 * set value for extra1_7 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra17
	 * @return EvalinstrNieuw
	 */
	public function &setExtra17($extra17) {
		$this->notifyChanged(self::FIELD_EXTRA1_7,$this->extra17,$extra17);
		$this->extra17=$extra17;
		return $this;
	}

	/**
	 * get value for extra1_7 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra17() {
		return $this->extra17;
	}

	/**
	 * set value for v1_8 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v18
	 * @return EvalinstrNieuw
	 */
	public function &setV18($v18) {
		$this->notifyChanged(self::FIELD_V1_8,$this->v18,$v18);
		$this->v18=$v18;
		return $this;
	}

	/**
	 * get value for v1_8 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV18() {
		return $this->v18;
	}

	/**
	 * set value for extra1_8 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra18
	 * @return EvalinstrNieuw
	 */
	public function &setExtra18($extra18) {
		$this->notifyChanged(self::FIELD_EXTRA1_8,$this->extra18,$extra18);
		$this->extra18=$extra18;
		return $this;
	}

	/**
	 * get value for extra1_8 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra18() {
		return $this->extra18;
	}

	/**
	 * set value for v1_9 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v19
	 * @return EvalinstrNieuw
	 */
	public function &setV19($v19) {
		$this->notifyChanged(self::FIELD_V1_9,$this->v19,$v19);
		$this->v19=$v19;
		return $this;
	}

	/**
	 * get value for v1_9 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV19() {
		return $this->v19;
	}

	/**
	 * set value for extra1_9 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra19
	 * @return EvalinstrNieuw
	 */
	public function &setExtra19($extra19) {
		$this->notifyChanged(self::FIELD_EXTRA1_9,$this->extra19,$extra19);
		$this->extra19=$extra19;
		return $this;
	}

	/**
	 * get value for extra1_9 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra19() {
		return $this->extra19;
	}

	/**
	 * set value for v1_10 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v110
	 * @return EvalinstrNieuw
	 */
	public function &setV110($v110) {
		$this->notifyChanged(self::FIELD_V1_10,$this->v110,$v110);
		$this->v110=$v110;
		return $this;
	}

	/**
	 * get value for v1_10 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV110() {
		return $this->v110;
	}

	/**
	 * set value for extra1_10 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra110
	 * @return EvalinstrNieuw
	 */
	public function &setExtra110($extra110) {
		$this->notifyChanged(self::FIELD_EXTRA1_10,$this->extra110,$extra110);
		$this->extra110=$extra110;
		return $this;
	}

	/**
	 * get value for extra1_10 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra110() {
		return $this->extra110;
	}

	/**
	 * set value for v1_11 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v111
	 * @return EvalinstrNieuw
	 */
	public function &setV111($v111) {
		$this->notifyChanged(self::FIELD_V1_11,$this->v111,$v111);
		$this->v111=$v111;
		return $this;
	}

	/**
	 * get value for v1_11 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV111() {
		return $this->v111;
	}

	/**
	 * set value for extra1_11 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra111
	 * @return EvalinstrNieuw
	 */
	public function &setExtra111($extra111) {
		$this->notifyChanged(self::FIELD_EXTRA1_11,$this->extra111,$extra111);
		$this->extra111=$extra111;
		return $this;
	}

	/**
	 * get value for extra1_11 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra111() {
		return $this->extra111;
	}

	/**
	 * set value for v1_12 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v112
	 * @return EvalinstrNieuw
	 */
	public function &setV112($v112) {
		$this->notifyChanged(self::FIELD_V1_12,$this->v112,$v112);
		$this->v112=$v112;
		return $this;
	}

	/**
	 * get value for v1_12 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV112() {
		return $this->v112;
	}

	/**
	 * set value for extra1_12 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra112
	 * @return EvalinstrNieuw
	 */
	public function &setExtra112($extra112) {
		$this->notifyChanged(self::FIELD_EXTRA1_12,$this->extra112,$extra112);
		$this->extra112=$extra112;
		return $this;
	}

	/**
	 * get value for extra1_12 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra112() {
		return $this->extra112;
	}

	/**
	 * set value for v1_13 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v113
	 * @return EvalinstrNieuw
	 */
	public function &setV113($v113) {
		$this->notifyChanged(self::FIELD_V1_13,$this->v113,$v113);
		$this->v113=$v113;
		return $this;
	}

	/**
	 * get value for v1_13 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV113() {
		return $this->v113;
	}

	/**
	 * set value for extra1_13 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra113
	 * @return EvalinstrNieuw
	 */
	public function &setExtra113($extra113) {
		$this->notifyChanged(self::FIELD_EXTRA1_13,$this->extra113,$extra113);
		$this->extra113=$extra113;
		return $this;
	}

	/**
	 * get value for extra1_13 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra113() {
		return $this->extra113;
	}

	/**
	 * set value for v1_14 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v114
	 * @return EvalinstrNieuw
	 */
	public function &setV114($v114) {
		$this->notifyChanged(self::FIELD_V1_14,$this->v114,$v114);
		$this->v114=$v114;
		return $this;
	}

	/**
	 * get value for v1_14 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV114() {
		return $this->v114;
	}

	/**
	 * set value for extra1_14 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra114
	 * @return EvalinstrNieuw
	 */
	public function &setExtra114($extra114) {
		$this->notifyChanged(self::FIELD_EXTRA1_14,$this->extra114,$extra114);
		$this->extra114=$extra114;
		return $this;
	}

	/**
	 * get value for extra1_14 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra114() {
		return $this->extra114;
	}

	/**
	 * set value for v1_15 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v115
	 * @return EvalinstrNieuw
	 */
	public function &setV115($v115) {
		$this->notifyChanged(self::FIELD_V1_15,$this->v115,$v115);
		$this->v115=$v115;
		return $this;
	}

	/**
	 * get value for v1_15 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV115() {
		return $this->v115;
	}

	/**
	 * set value for extra1_15 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra115
	 * @return EvalinstrNieuw
	 */
	public function &setExtra115($extra115) {
		$this->notifyChanged(self::FIELD_EXTRA1_15,$this->extra115,$extra115);
		$this->extra115=$extra115;
		return $this;
	}

	/**
	 * get value for extra1_15 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra115() {
		return $this->extra115;
	}

	/**
	 * set value for v1_16 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v116
	 * @return EvalinstrNieuw
	 */
	public function &setV116($v116) {
		$this->notifyChanged(self::FIELD_V1_16,$this->v116,$v116);
		$this->v116=$v116;
		return $this;
	}

	/**
	 * get value for v1_16 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV116() {
		return $this->v116;
	}

	/**
	 * set value for extra1_16 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra116
	 * @return EvalinstrNieuw
	 */
	public function &setExtra116($extra116) {
		$this->notifyChanged(self::FIELD_EXTRA1_16,$this->extra116,$extra116);
		$this->extra116=$extra116;
		return $this;
	}

	/**
	 * get value for extra1_16 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra116() {
		return $this->extra116;
	}

	/**
	 * set value for v1_17 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v117
	 * @return EvalinstrNieuw
	 */
	public function &setV117($v117) {
		$this->notifyChanged(self::FIELD_V1_17,$this->v117,$v117);
		$this->v117=$v117;
		return $this;
	}

	/**
	 * get value for v1_17 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV117() {
		return $this->v117;
	}

	/**
	 * set value for extra1_17 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra117
	 * @return EvalinstrNieuw
	 */
	public function &setExtra117($extra117) {
		$this->notifyChanged(self::FIELD_EXTRA1_17,$this->extra117,$extra117);
		$this->extra117=$extra117;
		return $this;
	}

	/**
	 * get value for extra1_17 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra117() {
		return $this->extra117;
	}

	/**
	 * set value for v1_18 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v118
	 * @return EvalinstrNieuw
	 */
	public function &setV118($v118) {
		$this->notifyChanged(self::FIELD_V1_18,$this->v118,$v118);
		$this->v118=$v118;
		return $this;
	}

	/**
	 * get value for v1_18 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV118() {
		return $this->v118;
	}

	/**
	 * set value for extra1_18 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra118
	 * @return EvalinstrNieuw
	 */
	public function &setExtra118($extra118) {
		$this->notifyChanged(self::FIELD_EXTRA1_18,$this->extra118,$extra118);
		$this->extra118=$extra118;
		return $this;
	}

	/**
	 * get value for extra1_18 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra118() {
		return $this->extra118;
	}

	/**
	 * set value for v1_19 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v119
	 * @return EvalinstrNieuw
	 */
	public function &setV119($v119) {
		$this->notifyChanged(self::FIELD_V1_19,$this->v119,$v119);
		$this->v119=$v119;
		return $this;
	}

	/**
	 * get value for v1_19 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV119() {
		return $this->v119;
	}

	/**
	 * set value for extra1_19 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra119
	 * @return EvalinstrNieuw
	 */
	public function &setExtra119($extra119) {
		$this->notifyChanged(self::FIELD_EXTRA1_19,$this->extra119,$extra119);
		$this->extra119=$extra119;
		return $this;
	}

	/**
	 * get value for extra1_19 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra119() {
		return $this->extra119;
	}

	/**
	 * set value for v1_20 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v120
	 * @return EvalinstrNieuw
	 */
	public function &setV120($v120) {
		$this->notifyChanged(self::FIELD_V1_20,$this->v120,$v120);
		$this->v120=$v120;
		return $this;
	}

	/**
	 * get value for v1_20 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV120() {
		return $this->v120;
	}

	/**
	 * set value for extra1_20 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra120
	 * @return EvalinstrNieuw
	 */
	public function &setExtra120($extra120) {
		$this->notifyChanged(self::FIELD_EXTRA1_20,$this->extra120,$extra120);
		$this->extra120=$extra120;
		return $this;
	}

	/**
	 * get value for extra1_20 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra120() {
		return $this->extra120;
	}

	/**
	 * set value for v1_21 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v121
	 * @return EvalinstrNieuw
	 */
	public function &setV121($v121) {
		$this->notifyChanged(self::FIELD_V1_21,$this->v121,$v121);
		$this->v121=$v121;
		return $this;
	}

	/**
	 * get value for v1_21 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV121() {
		return $this->v121;
	}

	/**
	 * set value for extra1_21 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra121
	 * @return EvalinstrNieuw
	 */
	public function &setExtra121($extra121) {
		$this->notifyChanged(self::FIELD_EXTRA1_21,$this->extra121,$extra121);
		$this->extra121=$extra121;
		return $this;
	}

	/**
	 * get value for extra1_21 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra121() {
		return $this->extra121;
	}

	/**
	 * set value for v1_22 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v122
	 * @return EvalinstrNieuw
	 */
	public function &setV122($v122) {
		$this->notifyChanged(self::FIELD_V1_22,$this->v122,$v122);
		$this->v122=$v122;
		return $this;
	}

	/**
	 * get value for v1_22 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV122() {
		return $this->v122;
	}

	/**
	 * set value for extra1_22 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra122
	 * @return EvalinstrNieuw
	 */
	public function &setExtra122($extra122) {
		$this->notifyChanged(self::FIELD_EXTRA1_22,$this->extra122,$extra122);
		$this->extra122=$extra122;
		return $this;
	}

	/**
	 * get value for extra1_22 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra122() {
		return $this->extra122;
	}

	/**
	 * set value for v2_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v21
	 * @return EvalinstrNieuw
	 */
	public function &setV21($v21) {
		$this->notifyChanged(self::FIELD_V2_1,$this->v21,$v21);
		$this->v21=$v21;
		return $this;
	}

	/**
	 * get value for v2_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV21() {
		return $this->v21;
	}

	/**
	 * set value for extra2_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra21
	 * @return EvalinstrNieuw
	 */
	public function &setExtra21($extra21) {
		$this->notifyChanged(self::FIELD_EXTRA2_1,$this->extra21,$extra21);
		$this->extra21=$extra21;
		return $this;
	}

	/**
	 * get value for extra2_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra21() {
		return $this->extra21;
	}

	/**
	 * set value for v2_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v22
	 * @return EvalinstrNieuw
	 */
	public function &setV22($v22) {
		$this->notifyChanged(self::FIELD_V2_2,$this->v22,$v22);
		$this->v22=$v22;
		return $this;
	}

	/**
	 * get value for v2_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV22() {
		return $this->v22;
	}

	/**
	 * set value for extra2_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra22
	 * @return EvalinstrNieuw
	 */
	public function &setExtra22($extra22) {
		$this->notifyChanged(self::FIELD_EXTRA2_2,$this->extra22,$extra22);
		$this->extra22=$extra22;
		return $this;
	}

	/**
	 * get value for extra2_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra22() {
		return $this->extra22;
	}

	/**
	 * set value for v2_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v23
	 * @return EvalinstrNieuw
	 */
	public function &setV23($v23) {
		$this->notifyChanged(self::FIELD_V2_3,$this->v23,$v23);
		$this->v23=$v23;
		return $this;
	}

	/**
	 * get value for v2_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV23() {
		return $this->v23;
	}

	/**
	 * set value for extra2_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra23
	 * @return EvalinstrNieuw
	 */
	public function &setExtra23($extra23) {
		$this->notifyChanged(self::FIELD_EXTRA2_3,$this->extra23,$extra23);
		$this->extra23=$extra23;
		return $this;
	}

	/**
	 * get value for extra2_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra23() {
		return $this->extra23;
	}

	/**
	 * set value for v2_4 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v24
	 * @return EvalinstrNieuw
	 */
	public function &setV24($v24) {
		$this->notifyChanged(self::FIELD_V2_4,$this->v24,$v24);
		$this->v24=$v24;
		return $this;
	}

	/**
	 * get value for v2_4 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV24() {
		return $this->v24;
	}

	/**
	 * set value for extra2_4 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra24
	 * @return EvalinstrNieuw
	 */
	public function &setExtra24($extra24) {
		$this->notifyChanged(self::FIELD_EXTRA2_4,$this->extra24,$extra24);
		$this->extra24=$extra24;
		return $this;
	}

	/**
	 * get value for extra2_4 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra24() {
		return $this->extra24;
	}

	/**
	 * set value for v2_5 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v25
	 * @return EvalinstrNieuw
	 */
	public function &setV25($v25) {
		$this->notifyChanged(self::FIELD_V2_5,$this->v25,$v25);
		$this->v25=$v25;
		return $this;
	}

	/**
	 * get value for v2_5 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV25() {
		return $this->v25;
	}

	/**
	 * set value for extra2_5 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra25
	 * @return EvalinstrNieuw
	 */
	public function &setExtra25($extra25) {
		$this->notifyChanged(self::FIELD_EXTRA2_5,$this->extra25,$extra25);
		$this->extra25=$extra25;
		return $this;
	}

	/**
	 * get value for extra2_5 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra25() {
		return $this->extra25;
	}

	/**
	 * set value for v2_6 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v26
	 * @return EvalinstrNieuw
	 */
	public function &setV26($v26) {
		$this->notifyChanged(self::FIELD_V2_6,$this->v26,$v26);
		$this->v26=$v26;
		return $this;
	}

	/**
	 * get value for v2_6 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV26() {
		return $this->v26;
	}

	/**
	 * set value for extra2_6 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra26
	 * @return EvalinstrNieuw
	 */
	public function &setExtra26($extra26) {
		$this->notifyChanged(self::FIELD_EXTRA2_6,$this->extra26,$extra26);
		$this->extra26=$extra26;
		return $this;
	}

	/**
	 * get value for extra2_6 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra26() {
		return $this->extra26;
	}

	/**
	 * set value for v2_7 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v27
	 * @return EvalinstrNieuw
	 */
	public function &setV27($v27) {
		$this->notifyChanged(self::FIELD_V2_7,$this->v27,$v27);
		$this->v27=$v27;
		return $this;
	}

	/**
	 * get value for v2_7 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV27() {
		return $this->v27;
	}

	/**
	 * set value for extra2_7 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra27
	 * @return EvalinstrNieuw
	 */
	public function &setExtra27($extra27) {
		$this->notifyChanged(self::FIELD_EXTRA2_7,$this->extra27,$extra27);
		$this->extra27=$extra27;
		return $this;
	}

	/**
	 * get value for extra2_7 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra27() {
		return $this->extra27;
	}

	/**
	 * set value for v2_8 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v28
	 * @return EvalinstrNieuw
	 */
	public function &setV28($v28) {
		$this->notifyChanged(self::FIELD_V2_8,$this->v28,$v28);
		$this->v28=$v28;
		return $this;
	}

	/**
	 * get value for v2_8 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV28() {
		return $this->v28;
	}

	/**
	 * set value for extra2_8 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra28
	 * @return EvalinstrNieuw
	 */
	public function &setExtra28($extra28) {
		$this->notifyChanged(self::FIELD_EXTRA2_8,$this->extra28,$extra28);
		$this->extra28=$extra28;
		return $this;
	}

	/**
	 * get value for extra2_8 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra28() {
		return $this->extra28;
	}

	/**
	 * set value for v2_9 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v29
	 * @return EvalinstrNieuw
	 */
	public function &setV29($v29) {
		$this->notifyChanged(self::FIELD_V2_9,$this->v29,$v29);
		$this->v29=$v29;
		return $this;
	}

	/**
	 * get value for v2_9 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV29() {
		return $this->v29;
	}

	/**
	 * set value for extra2_9 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra29
	 * @return EvalinstrNieuw
	 */
	public function &setExtra29($extra29) {
		$this->notifyChanged(self::FIELD_EXTRA2_9,$this->extra29,$extra29);
		$this->extra29=$extra29;
		return $this;
	}

	/**
	 * get value for extra2_9 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra29() {
		return $this->extra29;
	}

	/**
	 * set value for v2_10 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v210
	 * @return EvalinstrNieuw
	 */
	public function &setV210($v210) {
		$this->notifyChanged(self::FIELD_V2_10,$this->v210,$v210);
		$this->v210=$v210;
		return $this;
	}

	/**
	 * get value for v2_10 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV210() {
		return $this->v210;
	}

	/**
	 * set value for extra2_10 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra210
	 * @return EvalinstrNieuw
	 */
	public function &setExtra210($extra210) {
		$this->notifyChanged(self::FIELD_EXTRA2_10,$this->extra210,$extra210);
		$this->extra210=$extra210;
		return $this;
	}

	/**
	 * get value for extra2_10 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra210() {
		return $this->extra210;
	}

	/**
	 * set value for v2_11 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v211
	 * @return EvalinstrNieuw
	 */
	public function &setV211($v211) {
		$this->notifyChanged(self::FIELD_V2_11,$this->v211,$v211);
		$this->v211=$v211;
		return $this;
	}

	/**
	 * get value for v2_11 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV211() {
		return $this->v211;
	}

	/**
	 * set value for extra2_11 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra211
	 * @return EvalinstrNieuw
	 */
	public function &setExtra211($extra211) {
		$this->notifyChanged(self::FIELD_EXTRA2_11,$this->extra211,$extra211);
		$this->extra211=$extra211;
		return $this;
	}

	/**
	 * get value for extra2_11 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra211() {
		return $this->extra211;
	}

	/**
	 * set value for v3_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v31
	 * @return EvalinstrNieuw
	 */
	public function &setV31($v31) {
		$this->notifyChanged(self::FIELD_V3_1,$this->v31,$v31);
		$this->v31=$v31;
		return $this;
	}

	/**
	 * get value for v3_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV31() {
		return $this->v31;
	}

	/**
	 * set value for extra3_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra31
	 * @return EvalinstrNieuw
	 */
	public function &setExtra31($extra31) {
		$this->notifyChanged(self::FIELD_EXTRA3_1,$this->extra31,$extra31);
		$this->extra31=$extra31;
		return $this;
	}

	/**
	 * get value for extra3_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra31() {
		return $this->extra31;
	}

	/**
	 * set value for v3_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v32
	 * @return EvalinstrNieuw
	 */
	public function &setV32($v32) {
		$this->notifyChanged(self::FIELD_V3_2,$this->v32,$v32);
		$this->v32=$v32;
		return $this;
	}

	/**
	 * get value for v3_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV32() {
		return $this->v32;
	}

	/**
	 * set value for extra3_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra32
	 * @return EvalinstrNieuw
	 */
	public function &setExtra32($extra32) {
		$this->notifyChanged(self::FIELD_EXTRA3_2,$this->extra32,$extra32);
		$this->extra32=$extra32;
		return $this;
	}

	/**
	 * get value for extra3_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra32() {
		return $this->extra32;
	}

	/**
	 * set value for v3_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v33
	 * @return EvalinstrNieuw
	 */
	public function &setV33($v33) {
		$this->notifyChanged(self::FIELD_V3_3,$this->v33,$v33);
		$this->v33=$v33;
		return $this;
	}

	/**
	 * get value for v3_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV33() {
		return $this->v33;
	}

	/**
	 * set value for extra3_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra33
	 * @return EvalinstrNieuw
	 */
	public function &setExtra33($extra33) {
		$this->notifyChanged(self::FIELD_EXTRA3_3,$this->extra33,$extra33);
		$this->extra33=$extra33;
		return $this;
	}

	/**
	 * get value for extra3_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra33() {
		return $this->extra33;
	}

	/**
	 * set value for v4_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v41
	 * @return EvalinstrNieuw
	 */
	public function &setV41($v41) {
		$this->notifyChanged(self::FIELD_V4_1,$this->v41,$v41);
		$this->v41=$v41;
		return $this;
	}

	/**
	 * get value for v4_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV41() {
		return $this->v41;
	}

	/**
	 * set value for extra4_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra41
	 * @return EvalinstrNieuw
	 */
	public function &setExtra41($extra41) {
		$this->notifyChanged(self::FIELD_EXTRA4_1,$this->extra41,$extra41);
		$this->extra41=$extra41;
		return $this;
	}

	/**
	 * get value for extra4_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra41() {
		return $this->extra41;
	}

	/**
	 * set value for v4_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v42
	 * @return EvalinstrNieuw
	 */
	public function &setV42($v42) {
		$this->notifyChanged(self::FIELD_V4_2,$this->v42,$v42);
		$this->v42=$v42;
		return $this;
	}

	/**
	 * get value for v4_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV42() {
		return $this->v42;
	}

	/**
	 * set value for extra4_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra42
	 * @return EvalinstrNieuw
	 */
	public function &setExtra42($extra42) {
		$this->notifyChanged(self::FIELD_EXTRA4_2,$this->extra42,$extra42);
		$this->extra42=$extra42;
		return $this;
	}

	/**
	 * get value for extra4_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra42() {
		return $this->extra42;
	}

	/**
	 * set value for v4_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v43
	 * @return EvalinstrNieuw
	 */
	public function &setV43($v43) {
		$this->notifyChanged(self::FIELD_V4_3,$this->v43,$v43);
		$this->v43=$v43;
		return $this;
	}

	/**
	 * get value for v4_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV43() {
		return $this->v43;
	}

	/**
	 * set value for extra4_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra43
	 * @return EvalinstrNieuw
	 */
	public function &setExtra43($extra43) {
		$this->notifyChanged(self::FIELD_EXTRA4_3,$this->extra43,$extra43);
		$this->extra43=$extra43;
		return $this;
	}

	/**
	 * get value for extra4_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra43() {
		return $this->extra43;
	}

	/**
	 * set value for v4_4 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v44
	 * @return EvalinstrNieuw
	 */
	public function &setV44($v44) {
		$this->notifyChanged(self::FIELD_V4_4,$this->v44,$v44);
		$this->v44=$v44;
		return $this;
	}

	/**
	 * get value for v4_4 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV44() {
		return $this->v44;
	}

	/**
	 * set value for extra4_4 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra44
	 * @return EvalinstrNieuw
	 */
	public function &setExtra44($extra44) {
		$this->notifyChanged(self::FIELD_EXTRA4_4,$this->extra44,$extra44);
		$this->extra44=$extra44;
		return $this;
	}

	/**
	 * get value for extra4_4 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra44() {
		return $this->extra44;
	}

	/**
	 * set value for v5_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v51
	 * @return EvalinstrNieuw
	 */
	public function &setV51($v51) {
		$this->notifyChanged(self::FIELD_V5_1,$this->v51,$v51);
		$this->v51=$v51;
		return $this;
	}

	/**
	 * get value for v5_1 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV51() {
		return $this->v51;
	}

	/**
	 * set value for extra5_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra51
	 * @return EvalinstrNieuw
	 */
	public function &setExtra51($extra51) {
		$this->notifyChanged(self::FIELD_EXTRA5_1,$this->extra51,$extra51);
		$this->extra51=$extra51;
		return $this;
	}

	/**
	 * get value for extra5_1 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra51() {
		return $this->extra51;
	}

	/**
	 * set value for v5_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v52
	 * @return EvalinstrNieuw
	 */
	public function &setV52($v52) {
		$this->notifyChanged(self::FIELD_V5_2,$this->v52,$v52);
		$this->v52=$v52;
		return $this;
	}

	/**
	 * get value for v5_2 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV52() {
		return $this->v52;
	}

	/**
	 * set value for extra5_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra52
	 * @return EvalinstrNieuw
	 */
	public function &setExtra52($extra52) {
		$this->notifyChanged(self::FIELD_EXTRA5_2,$this->extra52,$extra52);
		$this->extra52=$extra52;
		return $this;
	}

	/**
	 * get value for extra5_2 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra52() {
		return $this->extra52;
	}

	/**
	 * set value for v5_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v53
	 * @return EvalinstrNieuw
	 */
	public function &setV53($v53) {
		$this->notifyChanged(self::FIELD_V5_3,$this->v53,$v53);
		$this->v53=$v53;
		return $this;
	}

	/**
	 * get value for v5_3 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV53() {
		return $this->v53;
	}

	/**
	 * set value for extra5_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra53
	 * @return EvalinstrNieuw
	 */
	public function &setExtra53($extra53) {
		$this->notifyChanged(self::FIELD_EXTRA5_3,$this->extra53,$extra53);
		$this->extra53=$extra53;
		return $this;
	}

	/**
	 * get value for extra5_3 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra53() {
		return $this->extra53;
	}

	/**
	 * set value for v5_4 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v54
	 * @return EvalinstrNieuw
	 */
	public function &setV54($v54) {
		$this->notifyChanged(self::FIELD_V5_4,$this->v54,$v54);
		$this->v54=$v54;
		return $this;
	}

	/**
	 * get value for v5_4 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV54() {
		return $this->v54;
	}

	/**
	 * set value for extra5_4 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra54
	 * @return EvalinstrNieuw
	 */
	public function &setExtra54($extra54) {
		$this->notifyChanged(self::FIELD_EXTRA5_4,$this->extra54,$extra54);
		$this->extra54=$extra54;
		return $this;
	}

	/**
	 * get value for extra5_4 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra54() {
		return $this->extra54;
	}

	/**
	 * set value for v5_5 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v55
	 * @return EvalinstrNieuw
	 */
	public function &setV55($v55) {
		$this->notifyChanged(self::FIELD_V5_5,$this->v55,$v55);
		$this->v55=$v55;
		return $this;
	}

	/**
	 * get value for v5_5 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV55() {
		return $this->v55;
	}

	/**
	 * set value for extra5_5 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra55
	 * @return EvalinstrNieuw
	 */
	public function &setExtra55($extra55) {
		$this->notifyChanged(self::FIELD_EXTRA5_5,$this->extra55,$extra55);
		$this->extra55=$extra55;
		return $this;
	}

	/**
	 * get value for extra5_5 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra55() {
		return $this->extra55;
	}

	/**
	 * set value for v5_6 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v56
	 * @return EvalinstrNieuw
	 */
	public function &setV56($v56) {
		$this->notifyChanged(self::FIELD_V5_6,$this->v56,$v56);
		$this->v56=$v56;
		return $this;
	}

	/**
	 * get value for v5_6 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV56() {
		return $this->v56;
	}

	/**
	 * set value for extra5_6 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra56
	 * @return EvalinstrNieuw
	 */
	public function &setExtra56($extra56) {
		$this->notifyChanged(self::FIELD_EXTRA5_6,$this->extra56,$extra56);
		$this->extra56=$extra56;
		return $this;
	}

	/**
	 * get value for extra5_6 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra56() {
		return $this->extra56;
	}

	/**
	 * set value for v5_7 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $v57
	 * @return EvalinstrNieuw
	 */
	public function &setV57($v57) {
		$this->notifyChanged(self::FIELD_V5_7,$this->v57,$v57);
		$this->v57=$v57;
		return $this;
	}

	/**
	 * get value for v5_7 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getV57() {
		return $this->v57;
	}

	/**
	 * set value for extra5_7 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $extra57
	 * @return EvalinstrNieuw
	 */
	public function &setExtra57($extra57) {
		$this->notifyChanged(self::FIELD_EXTRA5_7,$this->extra57,$extra57);
		$this->extra57=$extra57;
		return $this;
	}

	/**
	 * get value for extra5_7 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExtra57() {
		return $this->extra57;
	}

	/**
	 * set value for v6 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $v6
	 * @return EvalinstrNieuw
	 */
	public function &setV6($v6) {
		$this->notifyChanged(self::FIELD_V6,$this->v6,$v6);
		$this->v6=$v6;
		return $this;
	}

	/**
	 * get value for v6 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getV6() {
		return $this->v6;
	}

	/**
	 * set value for v7 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $v7
	 * @return EvalinstrNieuw
	 */
	public function &setV7($v7) {
		$this->notifyChanged(self::FIELD_V7,$this->v7,$v7);
		$this->v7=$v7;
		return $this;
	}

	/**
	 * get value for v7 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getV7() {
		return $this->v7;
	}

	/**
	 * set value for v8 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $v8
	 * @return EvalinstrNieuw
	 */
	public function &setV8($v8) {
		$this->notifyChanged(self::FIELD_V8,$this->v8,$v8);
		$this->v8=$v8;
		return $this;
	}

	/**
	 * get value for v8 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getV8() {
		return $this->v8;
	}

	/**
	 * Get table name
	 *
	 * @return string
	 */
	public static function getTableName() {
		return self::SQL_TABLE_NAME;
	}

	/**
	 * Get array with field id as index and field name as value
	 *
	 * @return array
	 */
	public static function getFieldNames() {
		return self::$FIELD_NAMES;
	}

	/**
	 * Get array with field id as index and property name as value
	 *
	 * @return array
	 */
	public static function getPropertyNames() {
		return self::$PROPERTY_NAMES;
	}

	/**
	 * get the field name for the passed field id.
	 *
	 * @param int $fieldId
	 * @param bool $fullyQualifiedName true if field name should be qualified by table name
	 * @return string field name for the passed field id, null if the field doesn't exist
	 */
	public static function getFieldNameByFieldId($fieldId, $fullyQualifiedName=true) {
		if (!array_key_exists($fieldId, self::$FIELD_NAMES)) {
			return null;
		}
		$fieldName=self::SQL_IDENTIFIER_QUOTE . self::$FIELD_NAMES[$fieldId] . self::SQL_IDENTIFIER_QUOTE;
		if ($fullyQualifiedName) {
			return self::SQL_IDENTIFIER_QUOTE . self::SQL_TABLE_NAME . self::SQL_IDENTIFIER_QUOTE . '.' . $fieldName;
		}
		return $fieldName;
	}

	/**
	 * Get array with field ids of identifiers
	 *
	 * @return array
	 */
	public static function getIdentifierFields() {
		return self::$PRIMARY_KEYS;
	}

	/**
	 * Get array with field ids of autoincrement fields
	 *
	 * @return array
	 */
	public static function getAutoincrementFields() {
		return self::$AUTOINCREMENT_FIELDS;
	}

	/**
	 * Get array with field id as index and property type as value
	 *
	 * @return array
	 */
	public static function getPropertyTypes() {
		return self::$PROPERTY_TYPES;
	}

	/**
	 * Get array with field id as index and field type as value
	 *
	 * @return array
	 */
	public static function getFieldTypes() {
		return self::$FIELD_TYPES;
	}

	/**
	 * Assign default values according to table
	 * 
	 */
	public function assignDefaultValues() {
		$this->assignByArray(self::$DEFAULT_VALUES);
	}


	/**
	 * return hash with the field name as index and the field value as value.
	 *
	 * @return array
	 */
	public function toHash() {
		$array=$this->toArray();
		$hash=array();
		foreach ($array as $fieldId=>$value) {
			$hash[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		return $hash;
	}

	/**
	 * return array with the field id as index and the field value as value.
	 *
	 * @return array
	 */
	public function toArray() {
		return array(
			self::FIELD_ID=>$this->getId(),
			self::FIELD_UITVOERDER_ID=>$this->getUitvoerderId(),
			self::FIELD_DD=>$this->getDd(),
			self::FIELD_MM=>$this->getMm(),
			self::FIELD_JJJJ=>$this->getJjjj(),
			self::FIELD_V1_1=>$this->getV11(),
			self::FIELD_EXTRA1_1=>$this->getExtra11(),
			self::FIELD_V1_2=>$this->getV12(),
			self::FIELD_EXTRA1_2=>$this->getExtra12(),
			self::FIELD_V1_3=>$this->getV13(),
			self::FIELD_EXTRA1_3=>$this->getExtra13(),
			self::FIELD_V1_4=>$this->getV14(),
			self::FIELD_EXTRA1_4=>$this->getExtra14(),
			self::FIELD_V1_5=>$this->getV15(),
			self::FIELD_EXTRA1_5=>$this->getExtra15(),
			self::FIELD_V1_6=>$this->getV16(),
			self::FIELD_EXTRA1_6=>$this->getExtra16(),
			self::FIELD_V1_7=>$this->getV17(),
			self::FIELD_EXTRA1_7=>$this->getExtra17(),
			self::FIELD_V1_8=>$this->getV18(),
			self::FIELD_EXTRA1_8=>$this->getExtra18(),
			self::FIELD_V1_9=>$this->getV19(),
			self::FIELD_EXTRA1_9=>$this->getExtra19(),
			self::FIELD_V1_10=>$this->getV110(),
			self::FIELD_EXTRA1_10=>$this->getExtra110(),
			self::FIELD_V1_11=>$this->getV111(),
			self::FIELD_EXTRA1_11=>$this->getExtra111(),
			self::FIELD_V1_12=>$this->getV112(),
			self::FIELD_EXTRA1_12=>$this->getExtra112(),
			self::FIELD_V1_13=>$this->getV113(),
			self::FIELD_EXTRA1_13=>$this->getExtra113(),
			self::FIELD_V1_14=>$this->getV114(),
			self::FIELD_EXTRA1_14=>$this->getExtra114(),
			self::FIELD_V1_15=>$this->getV115(),
			self::FIELD_EXTRA1_15=>$this->getExtra115(),
			self::FIELD_V1_16=>$this->getV116(),
			self::FIELD_EXTRA1_16=>$this->getExtra116(),
			self::FIELD_V1_17=>$this->getV117(),
			self::FIELD_EXTRA1_17=>$this->getExtra117(),
			self::FIELD_V1_18=>$this->getV118(),
			self::FIELD_EXTRA1_18=>$this->getExtra118(),
			self::FIELD_V1_19=>$this->getV119(),
			self::FIELD_EXTRA1_19=>$this->getExtra119(),
			self::FIELD_V1_20=>$this->getV120(),
			self::FIELD_EXTRA1_20=>$this->getExtra120(),
			self::FIELD_V1_21=>$this->getV121(),
			self::FIELD_EXTRA1_21=>$this->getExtra121(),
			self::FIELD_V1_22=>$this->getV122(),
			self::FIELD_EXTRA1_22=>$this->getExtra122(),
			self::FIELD_V2_1=>$this->getV21(),
			self::FIELD_EXTRA2_1=>$this->getExtra21(),
			self::FIELD_V2_2=>$this->getV22(),
			self::FIELD_EXTRA2_2=>$this->getExtra22(),
			self::FIELD_V2_3=>$this->getV23(),
			self::FIELD_EXTRA2_3=>$this->getExtra23(),
			self::FIELD_V2_4=>$this->getV24(),
			self::FIELD_EXTRA2_4=>$this->getExtra24(),
			self::FIELD_V2_5=>$this->getV25(),
			self::FIELD_EXTRA2_5=>$this->getExtra25(),
			self::FIELD_V2_6=>$this->getV26(),
			self::FIELD_EXTRA2_6=>$this->getExtra26(),
			self::FIELD_V2_7=>$this->getV27(),
			self::FIELD_EXTRA2_7=>$this->getExtra27(),
			self::FIELD_V2_8=>$this->getV28(),
			self::FIELD_EXTRA2_8=>$this->getExtra28(),
			self::FIELD_V2_9=>$this->getV29(),
			self::FIELD_EXTRA2_9=>$this->getExtra29(),
			self::FIELD_V2_10=>$this->getV210(),
			self::FIELD_EXTRA2_10=>$this->getExtra210(),
			self::FIELD_V2_11=>$this->getV211(),
			self::FIELD_EXTRA2_11=>$this->getExtra211(),
			self::FIELD_V3_1=>$this->getV31(),
			self::FIELD_EXTRA3_1=>$this->getExtra31(),
			self::FIELD_V3_2=>$this->getV32(),
			self::FIELD_EXTRA3_2=>$this->getExtra32(),
			self::FIELD_V3_3=>$this->getV33(),
			self::FIELD_EXTRA3_3=>$this->getExtra33(),
			self::FIELD_V4_1=>$this->getV41(),
			self::FIELD_EXTRA4_1=>$this->getExtra41(),
			self::FIELD_V4_2=>$this->getV42(),
			self::FIELD_EXTRA4_2=>$this->getExtra42(),
			self::FIELD_V4_3=>$this->getV43(),
			self::FIELD_EXTRA4_3=>$this->getExtra43(),
			self::FIELD_V4_4=>$this->getV44(),
			self::FIELD_EXTRA4_4=>$this->getExtra44(),
			self::FIELD_V5_1=>$this->getV51(),
			self::FIELD_EXTRA5_1=>$this->getExtra51(),
			self::FIELD_V5_2=>$this->getV52(),
			self::FIELD_EXTRA5_2=>$this->getExtra52(),
			self::FIELD_V5_3=>$this->getV53(),
			self::FIELD_EXTRA5_3=>$this->getExtra53(),
			self::FIELD_V5_4=>$this->getV54(),
			self::FIELD_EXTRA5_4=>$this->getExtra54(),
			self::FIELD_V5_5=>$this->getV55(),
			self::FIELD_EXTRA5_5=>$this->getExtra55(),
			self::FIELD_V5_6=>$this->getV56(),
			self::FIELD_EXTRA5_6=>$this->getExtra56(),
			self::FIELD_V5_7=>$this->getV57(),
			self::FIELD_EXTRA5_7=>$this->getExtra57(),
			self::FIELD_V6=>$this->getV6(),
			self::FIELD_V7=>$this->getV7(),
			self::FIELD_V8=>$this->getV8());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_ID=>$this->getId());
	}

	/**
	 * cached statements
	 *
	 * @var array<string,array<string,PDOStatement>>
	 */
	private static $stmts=array();
	private static $cacheStatements=true;
	
	/**
	 * prepare passed string as statement or return cached if enabled and available
	 *
	 * @param PDO $db
	 * @param string $statement
	 * @return PDOStatement
	 */
	protected static function prepareStatement(PDO $db, $statement) {
		if(self::isCacheStatements()) {
			if (in_array($statement, array(self::SQL_INSERT, self::SQL_INSERT_AUTOINCREMENT, self::SQL_UPDATE, self::SQL_SELECT_PK, self::SQL_DELETE_PK))) {
				$dbInstanceId=spl_object_hash($db);
				if (empty(self::$stmts[$statement][$dbInstanceId])) {
					self::$stmts[$statement][$dbInstanceId]=$db->prepare($statement);
				}
				return self::$stmts[$statement][$dbInstanceId];
			}
		}
		return $db->prepare($statement);
	}

	/**
	 * Enable statement cache
	 *
	 * @param bool $cache
	 */
	public static function setCacheStatements($cache) {
		self::$cacheStatements=true==$cache;
	}

	/**
	 * Check if statement cache is enabled
	 *
	 * @return bool
	 */
	public static function isCacheStatements() {
		return self::$cacheStatements;
	}
	
	/**
	 * check if this instance exists in the database
	 *
	 * @param PDO $db
	 * @return bool
	 */
	public function existsInDatabase(PDO $db) {
		$filter=array();
		foreach ($this->getPrimaryKeyValues() as $fieldId=>$value) {
			$filter[]=new DFC($fieldId, $value, DFC::EXACT_NULLSAFE);
		}
		return 0!=count(self::findByFilter($db, $filter, true));
	}
	
	/**
	 * Update to database if exists, otherwise insert
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateInsertToDatabase(PDO $db) {
		if ($this->existsInDatabase($db)) {
			return $this->updateToDatabase($db);
		} else {
			return $this->insertIntoDatabase($db);
		}
	}

	/**
	 * Query by Example.
	 *
	 * Match by attributes of passed example instance and return matched rows as an array of EvalinstrNieuw instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param EvalinstrNieuw $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return EvalinstrNieuw[]
	 */
	public static function findByExample(PDO $db,EvalinstrNieuw $example, $and=true, $sort=null) {
		$exampleValues=$example->toArray();
		$filter=array();
		foreach ($exampleValues as $fieldId=>$value) {
			if (null!==$value) {
				$filter[$fieldId]=$value;
			}
		}
		return self::findByFilter($db, $filter, $and, $sort);
	}

	/**
	 * Query by filter.
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * Will return matched rows as an array of EvalinstrNieuw instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return EvalinstrNieuw[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `evalinstr_nieuw`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of EvalinstrNieuw instances
	 *
	 * @param PDOStatement $stmt
	 * @return EvalinstrNieuw[]
	 */
	public static function fromStatement(PDOStatement $stmt) {
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * returns the result as an array of EvalinstrNieuw instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return EvalinstrNieuw[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new EvalinstrNieuw();
			$o->assignByHash($result);
			$o->notifyPristine();
			$resultInstances[]=$o;
		}
		$stmt->closeCursor();
		return $resultInstances;
	}

	/**
	 * Get sql WHERE part from filter.
	 *
	 * @param array $filter
	 * @param bool $and
	 * @param bool $fullyQualifiedNames true if field names should be qualified by table name
	 * @param bool $prependWhere true if WHERE should be prepended to conditions
	 * @return string
	 */
	public static function buildSqlWhere($filter, $and, $fullyQualifiedNames=true, $prependWhere=false) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		return $filter->buildSqlWhere(new self::$CLASS_NAME, $fullyQualifiedNames, $prependWhere);
	}

	/**
	 * get sql ORDER BY part from DSCs
	 *
	 * @param array $sort array of DSC instances
	 * @return string
	 */
	protected static function buildSqlOrderBy($sort) {
		return DSC::buildSqlOrderBy(new self::$CLASS_NAME, $sort);
	}

	/**
	 * bind values from filter to statement
	 *
	 * @param PDOStatement $stmt
	 * @param DFCInterface $filter
	 */
	public static function bindValuesForFilter(PDOStatement &$stmt, DFCInterface $filter) {
		$filter->bindValuesForFilter(new self::$CLASS_NAME, $stmt);
	}

	/**
	 * Execute select query and return matched rows as an array of EvalinstrNieuw instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return EvalinstrNieuw[]
	 */
	public static function findBySql(PDO $db, $sql) {
		$stmt=$db->query($sql);
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * Delete rows matching the filter
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * @param PDO $db
	 * @param array $filter
	 * @param bool $and
	 * @return mixed
	 */
	public static function deleteByFilter(PDO $db, $filter, $and=true) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		if (0==count($filter)) {
			throw new InvalidArgumentException('refusing to delete without filter'); // just comment out this line if you are brave
		}
		$sql='DELETE FROM `evalinstr_nieuw`'
		. self::buildSqlWhere($filter, $and, false, true);
		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Assign values from array with the field id as index and the value as value
	 *
	 * @param array $array
	 */
	public function assignByArray($array) {
		$result=array();
		foreach ($array as $fieldId=>$value) {
			$result[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		$this->assignByHash($result);
	}

	/**
	 * Assign values from hash where the indexes match the tables field names
	 *
	 * @param array $result
	 */
	public function assignByHash($result) {
		$this->setId($result['id']);
		$this->setUitvoerderId($result['uitvoerder_id']);
		$this->setDd($result['dd']);
		$this->setMm($result['mm']);
		$this->setJjjj($result['jjjj']);
		$this->setV11($result['v1_1']);
		$this->setExtra11($result['extra1_1']);
		$this->setV12($result['v1_2']);
		$this->setExtra12($result['extra1_2']);
		$this->setV13($result['v1_3']);
		$this->setExtra13($result['extra1_3']);
		$this->setV14($result['v1_4']);
		$this->setExtra14($result['extra1_4']);
		$this->setV15($result['v1_5']);
		$this->setExtra15($result['extra1_5']);
		$this->setV16($result['v1_6']);
		$this->setExtra16($result['extra1_6']);
		$this->setV17($result['v1_7']);
		$this->setExtra17($result['extra1_7']);
		$this->setV18($result['v1_8']);
		$this->setExtra18($result['extra1_8']);
		$this->setV19($result['v1_9']);
		$this->setExtra19($result['extra1_9']);
		$this->setV110($result['v1_10']);
		$this->setExtra110($result['extra1_10']);
		$this->setV111($result['v1_11']);
		$this->setExtra111($result['extra1_11']);
		$this->setV112($result['v1_12']);
		$this->setExtra112($result['extra1_12']);
		$this->setV113($result['v1_13']);
		$this->setExtra113($result['extra1_13']);
		$this->setV114($result['v1_14']);
		$this->setExtra114($result['extra1_14']);
		$this->setV115($result['v1_15']);
		$this->setExtra115($result['extra1_15']);
		$this->setV116($result['v1_16']);
		$this->setExtra116($result['extra1_16']);
		$this->setV117($result['v1_17']);
		$this->setExtra117($result['extra1_17']);
		$this->setV118($result['v1_18']);
		$this->setExtra118($result['extra1_18']);
		$this->setV119($result['v1_19']);
		$this->setExtra119($result['extra1_19']);
		$this->setV120($result['v1_20']);
		$this->setExtra120($result['extra1_20']);
		$this->setV121($result['v1_21']);
		$this->setExtra121($result['extra1_21']);
		$this->setV122($result['v1_22']);
		$this->setExtra122($result['extra1_22']);
		$this->setV21($result['v2_1']);
		$this->setExtra21($result['extra2_1']);
		$this->setV22($result['v2_2']);
		$this->setExtra22($result['extra2_2']);
		$this->setV23($result['v2_3']);
		$this->setExtra23($result['extra2_3']);
		$this->setV24($result['v2_4']);
		$this->setExtra24($result['extra2_4']);
		$this->setV25($result['v2_5']);
		$this->setExtra25($result['extra2_5']);
		$this->setV26($result['v2_6']);
		$this->setExtra26($result['extra2_6']);
		$this->setV27($result['v2_7']);
		$this->setExtra27($result['extra2_7']);
		$this->setV28($result['v2_8']);
		$this->setExtra28($result['extra2_8']);
		$this->setV29($result['v2_9']);
		$this->setExtra29($result['extra2_9']);
		$this->setV210($result['v2_10']);
		$this->setExtra210($result['extra2_10']);
		$this->setV211($result['v2_11']);
		$this->setExtra211($result['extra2_11']);
		$this->setV31($result['v3_1']);
		$this->setExtra31($result['extra3_1']);
		$this->setV32($result['v3_2']);
		$this->setExtra32($result['extra3_2']);
		$this->setV33($result['v3_3']);
		$this->setExtra33($result['extra3_3']);
		$this->setV41($result['v4_1']);
		$this->setExtra41($result['extra4_1']);
		$this->setV42($result['v4_2']);
		$this->setExtra42($result['extra4_2']);
		$this->setV43($result['v4_3']);
		$this->setExtra43($result['extra4_3']);
		$this->setV44($result['v4_4']);
		$this->setExtra44($result['extra4_4']);
		$this->setV51($result['v5_1']);
		$this->setExtra51($result['extra5_1']);
		$this->setV52($result['v5_2']);
		$this->setExtra52($result['extra5_2']);
		$this->setV53($result['v5_3']);
		$this->setExtra53($result['extra5_3']);
		$this->setV54($result['v5_4']);
		$this->setExtra54($result['extra5_4']);
		$this->setV55($result['v5_5']);
		$this->setExtra55($result['extra5_5']);
		$this->setV56($result['v5_6']);
		$this->setExtra56($result['extra5_6']);
		$this->setV57($result['v5_7']);
		$this->setExtra57($result['extra5_7']);
		$this->setV6($result['v6']);
		$this->setV7($result['v7']);
		$this->setV8($result['v8']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return EvalinstrNieuw
	 */
	public static function findById(PDO $db,$id) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$id);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		if(!$result) {
			return null;
		}
		$o=new EvalinstrNieuw();
		$o->assignByHash($result);
		$o->notifyPristine();
		return $o;
	}

	/**
	 * Bind all values to statement
	 *
	 * @param PDOStatement $stmt
	 */
	protected function bindValues(PDOStatement &$stmt) {
		$stmt->bindValue(1,$this->getId());
		$stmt->bindValue(2,$this->getUitvoerderId());
		$stmt->bindValue(3,$this->getDd());
		$stmt->bindValue(4,$this->getMm());
		$stmt->bindValue(5,$this->getJjjj());
		$stmt->bindValue(6,$this->getV11());
		$stmt->bindValue(7,$this->getExtra11());
		$stmt->bindValue(8,$this->getV12());
		$stmt->bindValue(9,$this->getExtra12());
		$stmt->bindValue(10,$this->getV13());
		$stmt->bindValue(11,$this->getExtra13());
		$stmt->bindValue(12,$this->getV14());
		$stmt->bindValue(13,$this->getExtra14());
		$stmt->bindValue(14,$this->getV15());
		$stmt->bindValue(15,$this->getExtra15());
		$stmt->bindValue(16,$this->getV16());
		$stmt->bindValue(17,$this->getExtra16());
		$stmt->bindValue(18,$this->getV17());
		$stmt->bindValue(19,$this->getExtra17());
		$stmt->bindValue(20,$this->getV18());
		$stmt->bindValue(21,$this->getExtra18());
		$stmt->bindValue(22,$this->getV19());
		$stmt->bindValue(23,$this->getExtra19());
		$stmt->bindValue(24,$this->getV110());
		$stmt->bindValue(25,$this->getExtra110());
		$stmt->bindValue(26,$this->getV111());
		$stmt->bindValue(27,$this->getExtra111());
		$stmt->bindValue(28,$this->getV112());
		$stmt->bindValue(29,$this->getExtra112());
		$stmt->bindValue(30,$this->getV113());
		$stmt->bindValue(31,$this->getExtra113());
		$stmt->bindValue(32,$this->getV114());
		$stmt->bindValue(33,$this->getExtra114());
		$stmt->bindValue(34,$this->getV115());
		$stmt->bindValue(35,$this->getExtra115());
		$stmt->bindValue(36,$this->getV116());
		$stmt->bindValue(37,$this->getExtra116());
		$stmt->bindValue(38,$this->getV117());
		$stmt->bindValue(39,$this->getExtra117());
		$stmt->bindValue(40,$this->getV118());
		$stmt->bindValue(41,$this->getExtra118());
		$stmt->bindValue(42,$this->getV119());
		$stmt->bindValue(43,$this->getExtra119());
		$stmt->bindValue(44,$this->getV120());
		$stmt->bindValue(45,$this->getExtra120());
		$stmt->bindValue(46,$this->getV121());
		$stmt->bindValue(47,$this->getExtra121());
		$stmt->bindValue(48,$this->getV122());
		$stmt->bindValue(49,$this->getExtra122());
		$stmt->bindValue(50,$this->getV21());
		$stmt->bindValue(51,$this->getExtra21());
		$stmt->bindValue(52,$this->getV22());
		$stmt->bindValue(53,$this->getExtra22());
		$stmt->bindValue(54,$this->getV23());
		$stmt->bindValue(55,$this->getExtra23());
		$stmt->bindValue(56,$this->getV24());
		$stmt->bindValue(57,$this->getExtra24());
		$stmt->bindValue(58,$this->getV25());
		$stmt->bindValue(59,$this->getExtra25());
		$stmt->bindValue(60,$this->getV26());
		$stmt->bindValue(61,$this->getExtra26());
		$stmt->bindValue(62,$this->getV27());
		$stmt->bindValue(63,$this->getExtra27());
		$stmt->bindValue(64,$this->getV28());
		$stmt->bindValue(65,$this->getExtra28());
		$stmt->bindValue(66,$this->getV29());
		$stmt->bindValue(67,$this->getExtra29());
		$stmt->bindValue(68,$this->getV210());
		$stmt->bindValue(69,$this->getExtra210());
		$stmt->bindValue(70,$this->getV211());
		$stmt->bindValue(71,$this->getExtra211());
		$stmt->bindValue(72,$this->getV31());
		$stmt->bindValue(73,$this->getExtra31());
		$stmt->bindValue(74,$this->getV32());
		$stmt->bindValue(75,$this->getExtra32());
		$stmt->bindValue(76,$this->getV33());
		$stmt->bindValue(77,$this->getExtra33());
		$stmt->bindValue(78,$this->getV41());
		$stmt->bindValue(79,$this->getExtra41());
		$stmt->bindValue(80,$this->getV42());
		$stmt->bindValue(81,$this->getExtra42());
		$stmt->bindValue(82,$this->getV43());
		$stmt->bindValue(83,$this->getExtra43());
		$stmt->bindValue(84,$this->getV44());
		$stmt->bindValue(85,$this->getExtra44());
		$stmt->bindValue(86,$this->getV51());
		$stmt->bindValue(87,$this->getExtra51());
		$stmt->bindValue(88,$this->getV52());
		$stmt->bindValue(89,$this->getExtra52());
		$stmt->bindValue(90,$this->getV53());
		$stmt->bindValue(91,$this->getExtra53());
		$stmt->bindValue(92,$this->getV54());
		$stmt->bindValue(93,$this->getExtra54());
		$stmt->bindValue(94,$this->getV55());
		$stmt->bindValue(95,$this->getExtra55());
		$stmt->bindValue(96,$this->getV56());
		$stmt->bindValue(97,$this->getExtra56());
		$stmt->bindValue(98,$this->getV57());
		$stmt->bindValue(99,$this->getExtra57());
		$stmt->bindValue(100,$this->getV6());
		$stmt->bindValue(101,$this->getV7());
		$stmt->bindValue(102,$this->getV8());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getUitvoerderId());
			$stmt->bindValue(2,$this->getDd());
			$stmt->bindValue(3,$this->getMm());
			$stmt->bindValue(4,$this->getJjjj());
			$stmt->bindValue(5,$this->getV11());
			$stmt->bindValue(6,$this->getExtra11());
			$stmt->bindValue(7,$this->getV12());
			$stmt->bindValue(8,$this->getExtra12());
			$stmt->bindValue(9,$this->getV13());
			$stmt->bindValue(10,$this->getExtra13());
			$stmt->bindValue(11,$this->getV14());
			$stmt->bindValue(12,$this->getExtra14());
			$stmt->bindValue(13,$this->getV15());
			$stmt->bindValue(14,$this->getExtra15());
			$stmt->bindValue(15,$this->getV16());
			$stmt->bindValue(16,$this->getExtra16());
			$stmt->bindValue(17,$this->getV17());
			$stmt->bindValue(18,$this->getExtra17());
			$stmt->bindValue(19,$this->getV18());
			$stmt->bindValue(20,$this->getExtra18());
			$stmt->bindValue(21,$this->getV19());
			$stmt->bindValue(22,$this->getExtra19());
			$stmt->bindValue(23,$this->getV110());
			$stmt->bindValue(24,$this->getExtra110());
			$stmt->bindValue(25,$this->getV111());
			$stmt->bindValue(26,$this->getExtra111());
			$stmt->bindValue(27,$this->getV112());
			$stmt->bindValue(28,$this->getExtra112());
			$stmt->bindValue(29,$this->getV113());
			$stmt->bindValue(30,$this->getExtra113());
			$stmt->bindValue(31,$this->getV114());
			$stmt->bindValue(32,$this->getExtra114());
			$stmt->bindValue(33,$this->getV115());
			$stmt->bindValue(34,$this->getExtra115());
			$stmt->bindValue(35,$this->getV116());
			$stmt->bindValue(36,$this->getExtra116());
			$stmt->bindValue(37,$this->getV117());
			$stmt->bindValue(38,$this->getExtra117());
			$stmt->bindValue(39,$this->getV118());
			$stmt->bindValue(40,$this->getExtra118());
			$stmt->bindValue(41,$this->getV119());
			$stmt->bindValue(42,$this->getExtra119());
			$stmt->bindValue(43,$this->getV120());
			$stmt->bindValue(44,$this->getExtra120());
			$stmt->bindValue(45,$this->getV121());
			$stmt->bindValue(46,$this->getExtra121());
			$stmt->bindValue(47,$this->getV122());
			$stmt->bindValue(48,$this->getExtra122());
			$stmt->bindValue(49,$this->getV21());
			$stmt->bindValue(50,$this->getExtra21());
			$stmt->bindValue(51,$this->getV22());
			$stmt->bindValue(52,$this->getExtra22());
			$stmt->bindValue(53,$this->getV23());
			$stmt->bindValue(54,$this->getExtra23());
			$stmt->bindValue(55,$this->getV24());
			$stmt->bindValue(56,$this->getExtra24());
			$stmt->bindValue(57,$this->getV25());
			$stmt->bindValue(58,$this->getExtra25());
			$stmt->bindValue(59,$this->getV26());
			$stmt->bindValue(60,$this->getExtra26());
			$stmt->bindValue(61,$this->getV27());
			$stmt->bindValue(62,$this->getExtra27());
			$stmt->bindValue(63,$this->getV28());
			$stmt->bindValue(64,$this->getExtra28());
			$stmt->bindValue(65,$this->getV29());
			$stmt->bindValue(66,$this->getExtra29());
			$stmt->bindValue(67,$this->getV210());
			$stmt->bindValue(68,$this->getExtra210());
			$stmt->bindValue(69,$this->getV211());
			$stmt->bindValue(70,$this->getExtra211());
			$stmt->bindValue(71,$this->getV31());
			$stmt->bindValue(72,$this->getExtra31());
			$stmt->bindValue(73,$this->getV32());
			$stmt->bindValue(74,$this->getExtra32());
			$stmt->bindValue(75,$this->getV33());
			$stmt->bindValue(76,$this->getExtra33());
			$stmt->bindValue(77,$this->getV41());
			$stmt->bindValue(78,$this->getExtra41());
			$stmt->bindValue(79,$this->getV42());
			$stmt->bindValue(80,$this->getExtra42());
			$stmt->bindValue(81,$this->getV43());
			$stmt->bindValue(82,$this->getExtra43());
			$stmt->bindValue(83,$this->getV44());
			$stmt->bindValue(84,$this->getExtra44());
			$stmt->bindValue(85,$this->getV51());
			$stmt->bindValue(86,$this->getExtra51());
			$stmt->bindValue(87,$this->getV52());
			$stmt->bindValue(88,$this->getExtra52());
			$stmt->bindValue(89,$this->getV53());
			$stmt->bindValue(90,$this->getExtra53());
			$stmt->bindValue(91,$this->getV54());
			$stmt->bindValue(92,$this->getExtra54());
			$stmt->bindValue(93,$this->getV55());
			$stmt->bindValue(94,$this->getExtra55());
			$stmt->bindValue(95,$this->getV56());
			$stmt->bindValue(96,$this->getExtra56());
			$stmt->bindValue(97,$this->getV57());
			$stmt->bindValue(98,$this->getExtra57());
			$stmt->bindValue(99,$this->getV6());
			$stmt->bindValue(100,$this->getV7());
			$stmt->bindValue(101,$this->getV8());
		} else {
			$stmt=self::prepareStatement($db,self::SQL_INSERT);
			$this->bindValues($stmt);
		}
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$lastInsertId=$db->lastInsertId();
		if (false!==$lastInsertId) {
			$this->setId($lastInsertId);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Update this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateToDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_UPDATE);
		$this->bindValues($stmt);
		$stmt->bindValue(103,$this->getId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Delete this instance from the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function deleteFromDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_DELETE_PK);
		$stmt->bindValue(1,$this->getId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'EvalinstrNieuw');
	}

	/**
	 * get single EvalinstrNieuw instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return EvalinstrNieuw
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new EvalinstrNieuw();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of EvalinstrNieuw from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return EvalinstrNieuw[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('EvalinstrNieuw') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>