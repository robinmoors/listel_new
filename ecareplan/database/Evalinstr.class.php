<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Evalinstr extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Evalinstr';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='evalinstr';
	const SQL_INSERT='INSERT INTO `evalinstr` (`ei_id`,`ei_datum`,`ei_01_01_s`,`ei_01_01_t`,`ei_01_02_s`,`ei_01_02_t`,`ei_01_03_s`,`ei_01_03_t`,`ei_01_04_s`,`ei_01_04_t`,`ei_01_05_s`,`ei_01_05_t`,`ei_01_06_s`,`ei_01_06_t`,`ei_01_07_s`,`ei_01_07_t`,`ei_02_01_s`,`ei_02_01_t`,`ei_02_02_s`,`ei_02_02_t`,`ei_02_03_s`,`ei_02_03_t`,`ei_02_04_s`,`ei_02_04_t`,`ei_02_05_s`,`ei_02_05_t`,`ei_02_06_s`,`ei_02_06_t`,`ei_02_07_s`,`ei_02_07_t`,`ei_02_08_s`,`ei_02_08_t`,`ei_02_09_s`,`ei_02_09_t`,`ei_031_01_s`,`ei_031_01_t`,`ei_031_02_s`,`ei_031_02_t`,`ei_031_03_s`,`ei_031_03_t`,`ei_031_04_s`,`ei_031_04_t`,`ei_031_05_s`,`ei_031_05_t`,`ei_031_06_s`,`ei_031_06_t`,`ei_031_07_s`,`ei_031_07_t`,`ei_031_08_s`,`ei_031_08_t`,`ei_032_01_s`,`ei_032_01_t`,`ei_032_02_s`,`ei_032_02_t`,`ei_032_03_s`,`ei_032_03_t`,`ei_032_04_s`,`ei_032_04_t`,`ei_032_05_s`,`ei_032_05_t`,`ei_032_06_s`,`ei_032_06_t`,`ei_032_07_s`,`ei_032_07_t`,`ei_032_08_s`,`ei_032_08_t`,`ei_032_09_s`,`ei_032_09_t`,`ei_032_10_s`,`ei_032_10_t`,`ei_032_11_s`,`ei_032_11_t`,`ei_032_12_s`,`ei_032_12_t`,`ei_032_13_s`,`ei_032_13_t`,`ei_032_14_s`,`ei_032_14_t`,`ei_033_01_s`,`ei_033_01_t`,`ei_033_02_s`,`ei_033_02_t`,`ei_033_03_s`,`ei_033_03_t`,`ei_033_04_s`,`ei_033_04_t`,`ei_033_05_s`,`ei_033_05_t`,`ei_033_06_s`,`ei_033_06_t`,`ei_033_07_s`,`ei_033_07_t`,`ei_033_08_s`,`ei_033_08_t`,`ei_04_01_s`,`ei_04_01_t`,`ei_04_02_s`,`ei_04_02_t`,`ei_04_03_s`,`ei_04_03_t`,`ei_04_04_s`,`ei_04_04_t`,`ei_04_05_s`,`ei_04_05_t`,`ei_04_06_s`,`ei_04_06_t`,`ei_04_07_s`,`ei_04_07_t`,`ei_04_08_s`,`ei_04_08_t`,`ei_04_09_s`,`ei_04_09_t`,`ei_04_10_s`,`ei_04_10_t`,`ei_04_11_s`,`ei_04_11_t`,`ei_04_12_s`,`ei_04_12_t`,`ei_04_13_s`,`ei_04_13_t`,`ei_04_14_s`,`ei_04_14_t`,`ei_05_01_s`,`ei_05_01_t`,`ei_05_02_s`,`ei_05_02_t`,`ei_05_03_s`,`ei_05_03_t`,`ei_05_04_s`,`ei_05_04_t`,`ei_05_05_s`,`ei_05_05_t`,`ei_05_06_s`,`ei_05_06_t`,`ei_05_07_s`,`ei_05_07_t`,`ei_05_08_s`,`ei_05_08_t`,`ei_05_09_s`,`ei_05_09_t`,`ei_05_10_s`,`ei_05_10_t`,`ei_05_11_s`,`ei_05_11_t`,`ei_05_12_s`,`ei_05_12_t`,`ei_05_13_s`,`ei_05_13_t`,`ei_05_14_s`,`ei_05_14_t`,`ei_06_01_s`,`ei_06_01_t`,`ei_06_02_s`,`ei_06_02_t`,`ei_06_03_s`,`ei_06_03_t`,`ei_06_04_s`,`ei_06_04_t`,`ei_06_05_s`,`ei_06_05_t`,`ei_06_06_s`,`ei_06_06_t`,`ei_06_07_s`,`ei_06_07_t`,`ei_06_08_s`,`ei_06_08_t`,`ei_06_09_s`,`ei_06_09_t`,`ei_06_10_s`,`ei_06_10_t`,`ei_06_11_s`,`ei_06_11_t`,`ei_07_01_s`,`ei_07_01_t`,`ei_07_02_s`,`ei_07_02_t`,`ei_07_03_s`,`ei_07_03_t`,`ei_07_04_s`,`ei_07_04_t`,`ei_07_05_s`,`ei_07_05_t`,`ei_07_06_s`,`ei_07_06_t`,`ei_07_07_s`,`ei_07_07_t`,`ei_07_08_s`,`ei_07_08_t`,`ei_081_01_s`,`ei_081_01_t`,`ei_081_02_s`,`ei_081_02_t`,`ei_081_03_s`,`ei_081_03_t`,`ei_081_04_s`,`ei_081_04_t`,`ei_081_05_s`,`ei_081_05_t`,`ei_081_06_s`,`ei_081_06_t`,`ei_081_07_s`,`ei_081_07_t`,`ei_081_08_s`,`ei_081_08_t`,`ei_081_09_s`,`ei_081_09_t`,`ei_081_10_s`,`ei_081_10_t`,`ei_081_11_s`,`ei_081_11_t`,`ei_081_12_s`,`ei_081_12_t`,`ei_081_13_s`,`ei_081_13_t`,`ei_081_14_s`,`ei_081_14_t`,`ei_081_15_s`,`ei_081_15_t`,`ei_081_16_s`,`ei_081_16_t`,`ei_081_17_s`,`ei_081_17_t`,`ei_081_18_s`,`ei_081_18_t`,`ei_081_19_s`,`ei_081_19_t`,`ei_082_01_s`,`ei_082_01_t`,`ei_082_02_s`,`ei_082_02_t`,`ei_082_03_s`,`ei_082_03_t`,`ei_082_04_s`,`ei_082_04_t`,`ei_082_05_s`,`ei_082_05_t`,`ei_082_06_s`,`ei_082_06_t`,`ei_082_07_s`,`ei_082_07_t`,`ei_082_08_s`,`ei_082_08_t`,`ei_082_09_s`,`ei_082_09_t`,`ei_082_10_s`,`ei_082_10_t`,`ei_082_11_s`,`ei_082_11_t`,`ei_082_12_s`,`ei_082_12_t`,`ei_082_13_s`,`ei_082_13_t`,`ei_082_14_s`,`ei_082_14_t`,`ei_082_15_s`,`ei_082_15_t`,`ei_082_16_s`,`ei_082_16_t`,`ei_082_17_s`,`ei_082_17_t`,`ei_082_18_s`,`ei_082_18_t`,`ei_082_19_s`,`ei_082_19_t`,`ei_082_20_s`,`ei_082_20_t`,`ei_082_21_s`,`ei_082_21_t`,`ei_082_22_s`,`ei_082_22_t`,`ei_082_23_s`,`ei_082_23_t`,`ei_082_24_s`,`ei_082_24_t`,`ei_082_25_s`,`ei_082_25_t`,`ei_082_26_s`,`ei_082_26_t`,`ei_082_27_s`,`ei_082_27_t`,`ei_09_01_t`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `evalinstr` (`ei_datum`,`ei_01_01_s`,`ei_01_01_t`,`ei_01_02_s`,`ei_01_02_t`,`ei_01_03_s`,`ei_01_03_t`,`ei_01_04_s`,`ei_01_04_t`,`ei_01_05_s`,`ei_01_05_t`,`ei_01_06_s`,`ei_01_06_t`,`ei_01_07_s`,`ei_01_07_t`,`ei_02_01_s`,`ei_02_01_t`,`ei_02_02_s`,`ei_02_02_t`,`ei_02_03_s`,`ei_02_03_t`,`ei_02_04_s`,`ei_02_04_t`,`ei_02_05_s`,`ei_02_05_t`,`ei_02_06_s`,`ei_02_06_t`,`ei_02_07_s`,`ei_02_07_t`,`ei_02_08_s`,`ei_02_08_t`,`ei_02_09_s`,`ei_02_09_t`,`ei_031_01_s`,`ei_031_01_t`,`ei_031_02_s`,`ei_031_02_t`,`ei_031_03_s`,`ei_031_03_t`,`ei_031_04_s`,`ei_031_04_t`,`ei_031_05_s`,`ei_031_05_t`,`ei_031_06_s`,`ei_031_06_t`,`ei_031_07_s`,`ei_031_07_t`,`ei_031_08_s`,`ei_031_08_t`,`ei_032_01_s`,`ei_032_01_t`,`ei_032_02_s`,`ei_032_02_t`,`ei_032_03_s`,`ei_032_03_t`,`ei_032_04_s`,`ei_032_04_t`,`ei_032_05_s`,`ei_032_05_t`,`ei_032_06_s`,`ei_032_06_t`,`ei_032_07_s`,`ei_032_07_t`,`ei_032_08_s`,`ei_032_08_t`,`ei_032_09_s`,`ei_032_09_t`,`ei_032_10_s`,`ei_032_10_t`,`ei_032_11_s`,`ei_032_11_t`,`ei_032_12_s`,`ei_032_12_t`,`ei_032_13_s`,`ei_032_13_t`,`ei_032_14_s`,`ei_032_14_t`,`ei_033_01_s`,`ei_033_01_t`,`ei_033_02_s`,`ei_033_02_t`,`ei_033_03_s`,`ei_033_03_t`,`ei_033_04_s`,`ei_033_04_t`,`ei_033_05_s`,`ei_033_05_t`,`ei_033_06_s`,`ei_033_06_t`,`ei_033_07_s`,`ei_033_07_t`,`ei_033_08_s`,`ei_033_08_t`,`ei_04_01_s`,`ei_04_01_t`,`ei_04_02_s`,`ei_04_02_t`,`ei_04_03_s`,`ei_04_03_t`,`ei_04_04_s`,`ei_04_04_t`,`ei_04_05_s`,`ei_04_05_t`,`ei_04_06_s`,`ei_04_06_t`,`ei_04_07_s`,`ei_04_07_t`,`ei_04_08_s`,`ei_04_08_t`,`ei_04_09_s`,`ei_04_09_t`,`ei_04_10_s`,`ei_04_10_t`,`ei_04_11_s`,`ei_04_11_t`,`ei_04_12_s`,`ei_04_12_t`,`ei_04_13_s`,`ei_04_13_t`,`ei_04_14_s`,`ei_04_14_t`,`ei_05_01_s`,`ei_05_01_t`,`ei_05_02_s`,`ei_05_02_t`,`ei_05_03_s`,`ei_05_03_t`,`ei_05_04_s`,`ei_05_04_t`,`ei_05_05_s`,`ei_05_05_t`,`ei_05_06_s`,`ei_05_06_t`,`ei_05_07_s`,`ei_05_07_t`,`ei_05_08_s`,`ei_05_08_t`,`ei_05_09_s`,`ei_05_09_t`,`ei_05_10_s`,`ei_05_10_t`,`ei_05_11_s`,`ei_05_11_t`,`ei_05_12_s`,`ei_05_12_t`,`ei_05_13_s`,`ei_05_13_t`,`ei_05_14_s`,`ei_05_14_t`,`ei_06_01_s`,`ei_06_01_t`,`ei_06_02_s`,`ei_06_02_t`,`ei_06_03_s`,`ei_06_03_t`,`ei_06_04_s`,`ei_06_04_t`,`ei_06_05_s`,`ei_06_05_t`,`ei_06_06_s`,`ei_06_06_t`,`ei_06_07_s`,`ei_06_07_t`,`ei_06_08_s`,`ei_06_08_t`,`ei_06_09_s`,`ei_06_09_t`,`ei_06_10_s`,`ei_06_10_t`,`ei_06_11_s`,`ei_06_11_t`,`ei_07_01_s`,`ei_07_01_t`,`ei_07_02_s`,`ei_07_02_t`,`ei_07_03_s`,`ei_07_03_t`,`ei_07_04_s`,`ei_07_04_t`,`ei_07_05_s`,`ei_07_05_t`,`ei_07_06_s`,`ei_07_06_t`,`ei_07_07_s`,`ei_07_07_t`,`ei_07_08_s`,`ei_07_08_t`,`ei_081_01_s`,`ei_081_01_t`,`ei_081_02_s`,`ei_081_02_t`,`ei_081_03_s`,`ei_081_03_t`,`ei_081_04_s`,`ei_081_04_t`,`ei_081_05_s`,`ei_081_05_t`,`ei_081_06_s`,`ei_081_06_t`,`ei_081_07_s`,`ei_081_07_t`,`ei_081_08_s`,`ei_081_08_t`,`ei_081_09_s`,`ei_081_09_t`,`ei_081_10_s`,`ei_081_10_t`,`ei_081_11_s`,`ei_081_11_t`,`ei_081_12_s`,`ei_081_12_t`,`ei_081_13_s`,`ei_081_13_t`,`ei_081_14_s`,`ei_081_14_t`,`ei_081_15_s`,`ei_081_15_t`,`ei_081_16_s`,`ei_081_16_t`,`ei_081_17_s`,`ei_081_17_t`,`ei_081_18_s`,`ei_081_18_t`,`ei_081_19_s`,`ei_081_19_t`,`ei_082_01_s`,`ei_082_01_t`,`ei_082_02_s`,`ei_082_02_t`,`ei_082_03_s`,`ei_082_03_t`,`ei_082_04_s`,`ei_082_04_t`,`ei_082_05_s`,`ei_082_05_t`,`ei_082_06_s`,`ei_082_06_t`,`ei_082_07_s`,`ei_082_07_t`,`ei_082_08_s`,`ei_082_08_t`,`ei_082_09_s`,`ei_082_09_t`,`ei_082_10_s`,`ei_082_10_t`,`ei_082_11_s`,`ei_082_11_t`,`ei_082_12_s`,`ei_082_12_t`,`ei_082_13_s`,`ei_082_13_t`,`ei_082_14_s`,`ei_082_14_t`,`ei_082_15_s`,`ei_082_15_t`,`ei_082_16_s`,`ei_082_16_t`,`ei_082_17_s`,`ei_082_17_t`,`ei_082_18_s`,`ei_082_18_t`,`ei_082_19_s`,`ei_082_19_t`,`ei_082_20_s`,`ei_082_20_t`,`ei_082_21_s`,`ei_082_21_t`,`ei_082_22_s`,`ei_082_22_t`,`ei_082_23_s`,`ei_082_23_t`,`ei_082_24_s`,`ei_082_24_t`,`ei_082_25_s`,`ei_082_25_t`,`ei_082_26_s`,`ei_082_26_t`,`ei_082_27_s`,`ei_082_27_t`,`ei_09_01_t`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `evalinstr` SET `ei_id`=?,`ei_datum`=?,`ei_01_01_s`=?,`ei_01_01_t`=?,`ei_01_02_s`=?,`ei_01_02_t`=?,`ei_01_03_s`=?,`ei_01_03_t`=?,`ei_01_04_s`=?,`ei_01_04_t`=?,`ei_01_05_s`=?,`ei_01_05_t`=?,`ei_01_06_s`=?,`ei_01_06_t`=?,`ei_01_07_s`=?,`ei_01_07_t`=?,`ei_02_01_s`=?,`ei_02_01_t`=?,`ei_02_02_s`=?,`ei_02_02_t`=?,`ei_02_03_s`=?,`ei_02_03_t`=?,`ei_02_04_s`=?,`ei_02_04_t`=?,`ei_02_05_s`=?,`ei_02_05_t`=?,`ei_02_06_s`=?,`ei_02_06_t`=?,`ei_02_07_s`=?,`ei_02_07_t`=?,`ei_02_08_s`=?,`ei_02_08_t`=?,`ei_02_09_s`=?,`ei_02_09_t`=?,`ei_031_01_s`=?,`ei_031_01_t`=?,`ei_031_02_s`=?,`ei_031_02_t`=?,`ei_031_03_s`=?,`ei_031_03_t`=?,`ei_031_04_s`=?,`ei_031_04_t`=?,`ei_031_05_s`=?,`ei_031_05_t`=?,`ei_031_06_s`=?,`ei_031_06_t`=?,`ei_031_07_s`=?,`ei_031_07_t`=?,`ei_031_08_s`=?,`ei_031_08_t`=?,`ei_032_01_s`=?,`ei_032_01_t`=?,`ei_032_02_s`=?,`ei_032_02_t`=?,`ei_032_03_s`=?,`ei_032_03_t`=?,`ei_032_04_s`=?,`ei_032_04_t`=?,`ei_032_05_s`=?,`ei_032_05_t`=?,`ei_032_06_s`=?,`ei_032_06_t`=?,`ei_032_07_s`=?,`ei_032_07_t`=?,`ei_032_08_s`=?,`ei_032_08_t`=?,`ei_032_09_s`=?,`ei_032_09_t`=?,`ei_032_10_s`=?,`ei_032_10_t`=?,`ei_032_11_s`=?,`ei_032_11_t`=?,`ei_032_12_s`=?,`ei_032_12_t`=?,`ei_032_13_s`=?,`ei_032_13_t`=?,`ei_032_14_s`=?,`ei_032_14_t`=?,`ei_033_01_s`=?,`ei_033_01_t`=?,`ei_033_02_s`=?,`ei_033_02_t`=?,`ei_033_03_s`=?,`ei_033_03_t`=?,`ei_033_04_s`=?,`ei_033_04_t`=?,`ei_033_05_s`=?,`ei_033_05_t`=?,`ei_033_06_s`=?,`ei_033_06_t`=?,`ei_033_07_s`=?,`ei_033_07_t`=?,`ei_033_08_s`=?,`ei_033_08_t`=?,`ei_04_01_s`=?,`ei_04_01_t`=?,`ei_04_02_s`=?,`ei_04_02_t`=?,`ei_04_03_s`=?,`ei_04_03_t`=?,`ei_04_04_s`=?,`ei_04_04_t`=?,`ei_04_05_s`=?,`ei_04_05_t`=?,`ei_04_06_s`=?,`ei_04_06_t`=?,`ei_04_07_s`=?,`ei_04_07_t`=?,`ei_04_08_s`=?,`ei_04_08_t`=?,`ei_04_09_s`=?,`ei_04_09_t`=?,`ei_04_10_s`=?,`ei_04_10_t`=?,`ei_04_11_s`=?,`ei_04_11_t`=?,`ei_04_12_s`=?,`ei_04_12_t`=?,`ei_04_13_s`=?,`ei_04_13_t`=?,`ei_04_14_s`=?,`ei_04_14_t`=?,`ei_05_01_s`=?,`ei_05_01_t`=?,`ei_05_02_s`=?,`ei_05_02_t`=?,`ei_05_03_s`=?,`ei_05_03_t`=?,`ei_05_04_s`=?,`ei_05_04_t`=?,`ei_05_05_s`=?,`ei_05_05_t`=?,`ei_05_06_s`=?,`ei_05_06_t`=?,`ei_05_07_s`=?,`ei_05_07_t`=?,`ei_05_08_s`=?,`ei_05_08_t`=?,`ei_05_09_s`=?,`ei_05_09_t`=?,`ei_05_10_s`=?,`ei_05_10_t`=?,`ei_05_11_s`=?,`ei_05_11_t`=?,`ei_05_12_s`=?,`ei_05_12_t`=?,`ei_05_13_s`=?,`ei_05_13_t`=?,`ei_05_14_s`=?,`ei_05_14_t`=?,`ei_06_01_s`=?,`ei_06_01_t`=?,`ei_06_02_s`=?,`ei_06_02_t`=?,`ei_06_03_s`=?,`ei_06_03_t`=?,`ei_06_04_s`=?,`ei_06_04_t`=?,`ei_06_05_s`=?,`ei_06_05_t`=?,`ei_06_06_s`=?,`ei_06_06_t`=?,`ei_06_07_s`=?,`ei_06_07_t`=?,`ei_06_08_s`=?,`ei_06_08_t`=?,`ei_06_09_s`=?,`ei_06_09_t`=?,`ei_06_10_s`=?,`ei_06_10_t`=?,`ei_06_11_s`=?,`ei_06_11_t`=?,`ei_07_01_s`=?,`ei_07_01_t`=?,`ei_07_02_s`=?,`ei_07_02_t`=?,`ei_07_03_s`=?,`ei_07_03_t`=?,`ei_07_04_s`=?,`ei_07_04_t`=?,`ei_07_05_s`=?,`ei_07_05_t`=?,`ei_07_06_s`=?,`ei_07_06_t`=?,`ei_07_07_s`=?,`ei_07_07_t`=?,`ei_07_08_s`=?,`ei_07_08_t`=?,`ei_081_01_s`=?,`ei_081_01_t`=?,`ei_081_02_s`=?,`ei_081_02_t`=?,`ei_081_03_s`=?,`ei_081_03_t`=?,`ei_081_04_s`=?,`ei_081_04_t`=?,`ei_081_05_s`=?,`ei_081_05_t`=?,`ei_081_06_s`=?,`ei_081_06_t`=?,`ei_081_07_s`=?,`ei_081_07_t`=?,`ei_081_08_s`=?,`ei_081_08_t`=?,`ei_081_09_s`=?,`ei_081_09_t`=?,`ei_081_10_s`=?,`ei_081_10_t`=?,`ei_081_11_s`=?,`ei_081_11_t`=?,`ei_081_12_s`=?,`ei_081_12_t`=?,`ei_081_13_s`=?,`ei_081_13_t`=?,`ei_081_14_s`=?,`ei_081_14_t`=?,`ei_081_15_s`=?,`ei_081_15_t`=?,`ei_081_16_s`=?,`ei_081_16_t`=?,`ei_081_17_s`=?,`ei_081_17_t`=?,`ei_081_18_s`=?,`ei_081_18_t`=?,`ei_081_19_s`=?,`ei_081_19_t`=?,`ei_082_01_s`=?,`ei_082_01_t`=?,`ei_082_02_s`=?,`ei_082_02_t`=?,`ei_082_03_s`=?,`ei_082_03_t`=?,`ei_082_04_s`=?,`ei_082_04_t`=?,`ei_082_05_s`=?,`ei_082_05_t`=?,`ei_082_06_s`=?,`ei_082_06_t`=?,`ei_082_07_s`=?,`ei_082_07_t`=?,`ei_082_08_s`=?,`ei_082_08_t`=?,`ei_082_09_s`=?,`ei_082_09_t`=?,`ei_082_10_s`=?,`ei_082_10_t`=?,`ei_082_11_s`=?,`ei_082_11_t`=?,`ei_082_12_s`=?,`ei_082_12_t`=?,`ei_082_13_s`=?,`ei_082_13_t`=?,`ei_082_14_s`=?,`ei_082_14_t`=?,`ei_082_15_s`=?,`ei_082_15_t`=?,`ei_082_16_s`=?,`ei_082_16_t`=?,`ei_082_17_s`=?,`ei_082_17_t`=?,`ei_082_18_s`=?,`ei_082_18_t`=?,`ei_082_19_s`=?,`ei_082_19_t`=?,`ei_082_20_s`=?,`ei_082_20_t`=?,`ei_082_21_s`=?,`ei_082_21_t`=?,`ei_082_22_s`=?,`ei_082_22_t`=?,`ei_082_23_s`=?,`ei_082_23_t`=?,`ei_082_24_s`=?,`ei_082_24_t`=?,`ei_082_25_s`=?,`ei_082_25_t`=?,`ei_082_26_s`=?,`ei_082_26_t`=?,`ei_082_27_s`=?,`ei_082_27_t`=?,`ei_09_01_t`=? WHERE `ei_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `evalinstr` WHERE `ei_id`=?';
	const SQL_DELETE_PK='DELETE FROM `evalinstr` WHERE `ei_id`=?';
	const FIELD_EI_ID=-951388424;
	const FIELD_EI_DATUM=-327944846;
	const FIELD_EI_01_01_S=-1923638922;
	const FIELD_EI_01_01_T=-1923638921;
	const FIELD_EI_01_02_S=-1923637961;
	const FIELD_EI_01_02_T=-1923637960;
	const FIELD_EI_01_03_S=-1923637000;
	const FIELD_EI_01_03_T=-1923636999;
	const FIELD_EI_01_04_S=-1923636039;
	const FIELD_EI_01_04_T=-1923636038;
	const FIELD_EI_01_05_S=-1923635078;
	const FIELD_EI_01_05_T=-1923635077;
	const FIELD_EI_01_06_S=-1923634117;
	const FIELD_EI_01_06_T=-1923634116;
	const FIELD_EI_01_07_S=-1923633156;
	const FIELD_EI_01_07_T=-1923633155;
	const FIELD_EI_02_01_S=-1895009771;
	const FIELD_EI_02_01_T=-1895009770;
	const FIELD_EI_02_02_S=-1895008810;
	const FIELD_EI_02_02_T=-1895008809;
	const FIELD_EI_02_03_S=-1895007849;
	const FIELD_EI_02_03_T=-1895007848;
	const FIELD_EI_02_04_S=-1895006888;
	const FIELD_EI_02_04_T=-1895006887;
	const FIELD_EI_02_05_S=-1895005927;
	const FIELD_EI_02_05_T=-1895005926;
	const FIELD_EI_02_06_S=-1895004966;
	const FIELD_EI_02_06_T=-1895004965;
	const FIELD_EI_02_07_S=-1895004005;
	const FIELD_EI_02_07_T=-1895004004;
	const FIELD_EI_02_08_S=-1895003044;
	const FIELD_EI_02_08_T=-1895003043;
	const FIELD_EI_02_09_S=-1895002083;
	const FIELD_EI_02_09_T=-1895002082;
	const FIELD_EI_031_01_S=998132963;
	const FIELD_EI_031_01_T=998132964;
	const FIELD_EI_031_02_S=998133924;
	const FIELD_EI_031_02_T=998133925;
	const FIELD_EI_031_03_S=998134885;
	const FIELD_EI_031_03_T=998134886;
	const FIELD_EI_031_04_S=998135846;
	const FIELD_EI_031_04_T=998135847;
	const FIELD_EI_031_05_S=998136807;
	const FIELD_EI_031_05_T=998136808;
	const FIELD_EI_031_06_S=998137768;
	const FIELD_EI_031_06_T=998137769;
	const FIELD_EI_031_07_S=998138729;
	const FIELD_EI_031_07_T=998138730;
	const FIELD_EI_031_08_S=998139690;
	const FIELD_EI_031_08_T=998139691;
	const FIELD_EI_032_01_S=1026762114;
	const FIELD_EI_032_01_T=1026762115;
	const FIELD_EI_032_02_S=1026763075;
	const FIELD_EI_032_02_T=1026763076;
	const FIELD_EI_032_03_S=1026764036;
	const FIELD_EI_032_03_T=1026764037;
	const FIELD_EI_032_04_S=1026764997;
	const FIELD_EI_032_04_T=1026764998;
	const FIELD_EI_032_05_S=1026765958;
	const FIELD_EI_032_05_T=1026765959;
	const FIELD_EI_032_06_S=1026766919;
	const FIELD_EI_032_06_T=1026766920;
	const FIELD_EI_032_07_S=1026767880;
	const FIELD_EI_032_07_T=1026767881;
	const FIELD_EI_032_08_S=1026768841;
	const FIELD_EI_032_08_T=1026768842;
	const FIELD_EI_032_09_S=1026769802;
	const FIELD_EI_032_09_T=1026769803;
	const FIELD_EI_032_10_S=1026790944;
	const FIELD_EI_032_10_T=1026790945;
	const FIELD_EI_032_11_S=1026791905;
	const FIELD_EI_032_11_T=1026791906;
	const FIELD_EI_032_12_S=1026792866;
	const FIELD_EI_032_12_T=1026792867;
	const FIELD_EI_032_13_S=1026793827;
	const FIELD_EI_032_13_T=1026793828;
	const FIELD_EI_032_14_S=1026794788;
	const FIELD_EI_032_14_T=1026794789;
	const FIELD_EI_033_01_S=1055391265;
	const FIELD_EI_033_01_T=1055391266;
	const FIELD_EI_033_02_S=1055392226;
	const FIELD_EI_033_02_T=1055392227;
	const FIELD_EI_033_03_S=1055393187;
	const FIELD_EI_033_03_T=1055393188;
	const FIELD_EI_033_04_S=1055394148;
	const FIELD_EI_033_04_T=1055394149;
	const FIELD_EI_033_05_S=1055395109;
	const FIELD_EI_033_05_T=1055395110;
	const FIELD_EI_033_06_S=1055396070;
	const FIELD_EI_033_06_T=1055396071;
	const FIELD_EI_033_07_S=1055397031;
	const FIELD_EI_033_07_T=1055397032;
	const FIELD_EI_033_08_S=1055397992;
	const FIELD_EI_033_08_T=1055397993;
	const FIELD_EI_04_01_S=-1837751469;
	const FIELD_EI_04_01_T=-1837751468;
	const FIELD_EI_04_02_S=-1837750508;
	const FIELD_EI_04_02_T=-1837750507;
	const FIELD_EI_04_03_S=-1837749547;
	const FIELD_EI_04_03_T=-1837749546;
	const FIELD_EI_04_04_S=-1837748586;
	const FIELD_EI_04_04_T=-1837748585;
	const FIELD_EI_04_05_S=-1837747625;
	const FIELD_EI_04_05_T=-1837747624;
	const FIELD_EI_04_06_S=-1837746664;
	const FIELD_EI_04_06_T=-1837746663;
	const FIELD_EI_04_07_S=-1837745703;
	const FIELD_EI_04_07_T=-1837745702;
	const FIELD_EI_04_08_S=-1837744742;
	const FIELD_EI_04_08_T=-1837744741;
	const FIELD_EI_04_09_S=-1837743781;
	const FIELD_EI_04_09_T=-1837743780;
	const FIELD_EI_04_10_S=-1837722639;
	const FIELD_EI_04_10_T=-1837722638;
	const FIELD_EI_04_11_S=-1837721678;
	const FIELD_EI_04_11_T=-1837721677;
	const FIELD_EI_04_12_S=-1837720717;
	const FIELD_EI_04_12_T=-1837720716;
	const FIELD_EI_04_13_S=-1837719756;
	const FIELD_EI_04_13_T=-1837719755;
	const FIELD_EI_04_14_S=-1837718795;
	const FIELD_EI_04_14_T=-1837718794;
	const FIELD_EI_05_01_S=-1809122318;
	const FIELD_EI_05_01_T=-1809122317;
	const FIELD_EI_05_02_S=-1809121357;
	const FIELD_EI_05_02_T=-1809121356;
	const FIELD_EI_05_03_S=-1809120396;
	const FIELD_EI_05_03_T=-1809120395;
	const FIELD_EI_05_04_S=-1809119435;
	const FIELD_EI_05_04_T=-1809119434;
	const FIELD_EI_05_05_S=-1809118474;
	const FIELD_EI_05_05_T=-1809118473;
	const FIELD_EI_05_06_S=-1809117513;
	const FIELD_EI_05_06_T=-1809117512;
	const FIELD_EI_05_07_S=-1809116552;
	const FIELD_EI_05_07_T=-1809116551;
	const FIELD_EI_05_08_S=-1809115591;
	const FIELD_EI_05_08_T=-1809115590;
	const FIELD_EI_05_09_S=-1809114630;
	const FIELD_EI_05_09_T=-1809114629;
	const FIELD_EI_05_10_S=-1809093488;
	const FIELD_EI_05_10_T=-1809093487;
	const FIELD_EI_05_11_S=-1809092527;
	const FIELD_EI_05_11_T=-1809092526;
	const FIELD_EI_05_12_S=-1809091566;
	const FIELD_EI_05_12_T=-1809091565;
	const FIELD_EI_05_13_S=-1809090605;
	const FIELD_EI_05_13_T=-1809090604;
	const FIELD_EI_05_14_S=-1809089644;
	const FIELD_EI_05_14_T=-1809089643;
	const FIELD_EI_06_01_S=-1780493167;
	const FIELD_EI_06_01_T=-1780493166;
	const FIELD_EI_06_02_S=-1780492206;
	const FIELD_EI_06_02_T=-1780492205;
	const FIELD_EI_06_03_S=-1780491245;
	const FIELD_EI_06_03_T=-1780491244;
	const FIELD_EI_06_04_S=-1780490284;
	const FIELD_EI_06_04_T=-1780490283;
	const FIELD_EI_06_05_S=-1780489323;
	const FIELD_EI_06_05_T=-1780489322;
	const FIELD_EI_06_06_S=-1780488362;
	const FIELD_EI_06_06_T=-1780488361;
	const FIELD_EI_06_07_S=-1780487401;
	const FIELD_EI_06_07_T=-1780487400;
	const FIELD_EI_06_08_S=-1780486440;
	const FIELD_EI_06_08_T=-1780486439;
	const FIELD_EI_06_09_S=-1780485479;
	const FIELD_EI_06_09_T=-1780485478;
	const FIELD_EI_06_10_S=-1780464337;
	const FIELD_EI_06_10_T=-1780464336;
	const FIELD_EI_06_11_S=-1780463376;
	const FIELD_EI_06_11_T=-1780463375;
	const FIELD_EI_07_01_S=-1751864016;
	const FIELD_EI_07_01_T=-1751864015;
	const FIELD_EI_07_02_S=-1751863055;
	const FIELD_EI_07_02_T=-1751863054;
	const FIELD_EI_07_03_S=-1751862094;
	const FIELD_EI_07_03_T=-1751862093;
	const FIELD_EI_07_04_S=-1751861133;
	const FIELD_EI_07_04_T=-1751861132;
	const FIELD_EI_07_05_S=-1751860172;
	const FIELD_EI_07_05_T=-1751860171;
	const FIELD_EI_07_06_S=-1751859211;
	const FIELD_EI_07_06_T=-1751859210;
	const FIELD_EI_07_07_S=-1751858250;
	const FIELD_EI_07_07_T=-1751858249;
	const FIELD_EI_07_08_S=-1751857289;
	const FIELD_EI_07_08_T=-1751857288;
	const FIELD_EI_081_01_S=1140684072;
	const FIELD_EI_081_01_T=1140684073;
	const FIELD_EI_081_02_S=1140685033;
	const FIELD_EI_081_02_T=1140685034;
	const FIELD_EI_081_03_S=1140685994;
	const FIELD_EI_081_03_T=1140685995;
	const FIELD_EI_081_04_S=1140686955;
	const FIELD_EI_081_04_T=1140686956;
	const FIELD_EI_081_05_S=1140687916;
	const FIELD_EI_081_05_T=1140687917;
	const FIELD_EI_081_06_S=1140688877;
	const FIELD_EI_081_06_T=1140688878;
	const FIELD_EI_081_07_S=1140689838;
	const FIELD_EI_081_07_T=1140689839;
	const FIELD_EI_081_08_S=1140690799;
	const FIELD_EI_081_08_T=1140690800;
	const FIELD_EI_081_09_S=1140691760;
	const FIELD_EI_081_09_T=1140691761;
	const FIELD_EI_081_10_S=1140712902;
	const FIELD_EI_081_10_T=1140712903;
	const FIELD_EI_081_11_S=1140713863;
	const FIELD_EI_081_11_T=1140713864;
	const FIELD_EI_081_12_S=1140714824;
	const FIELD_EI_081_12_T=1140714825;
	const FIELD_EI_081_13_S=1140715785;
	const FIELD_EI_081_13_T=1140715786;
	const FIELD_EI_081_14_S=1140716746;
	const FIELD_EI_081_14_T=1140716747;
	const FIELD_EI_081_15_S=1140717707;
	const FIELD_EI_081_15_T=1140717708;
	const FIELD_EI_081_16_S=1140718668;
	const FIELD_EI_081_16_T=1140718669;
	const FIELD_EI_081_17_S=1140719629;
	const FIELD_EI_081_17_T=1140719630;
	const FIELD_EI_081_18_S=1140720590;
	const FIELD_EI_081_18_T=1140720591;
	const FIELD_EI_081_19_S=1140721551;
	const FIELD_EI_081_19_T=1140721552;
	const FIELD_EI_082_01_S=1169313223;
	const FIELD_EI_082_01_T=1169313224;
	const FIELD_EI_082_02_S=1169314184;
	const FIELD_EI_082_02_T=1169314185;
	const FIELD_EI_082_03_S=1169315145;
	const FIELD_EI_082_03_T=1169315146;
	const FIELD_EI_082_04_S=1169316106;
	const FIELD_EI_082_04_T=1169316107;
	const FIELD_EI_082_05_S=1169317067;
	const FIELD_EI_082_05_T=1169317068;
	const FIELD_EI_082_06_S=1169318028;
	const FIELD_EI_082_06_T=1169318029;
	const FIELD_EI_082_07_S=1169318989;
	const FIELD_EI_082_07_T=1169318990;
	const FIELD_EI_082_08_S=1169319950;
	const FIELD_EI_082_08_T=1169319951;
	const FIELD_EI_082_09_S=1169320911;
	const FIELD_EI_082_09_T=1169320912;
	const FIELD_EI_082_10_S=1169342053;
	const FIELD_EI_082_10_T=1169342054;
	const FIELD_EI_082_11_S=1169343014;
	const FIELD_EI_082_11_T=1169343015;
	const FIELD_EI_082_12_S=1169343975;
	const FIELD_EI_082_12_T=1169343976;
	const FIELD_EI_082_13_S=1169344936;
	const FIELD_EI_082_13_T=1169344937;
	const FIELD_EI_082_14_S=1169345897;
	const FIELD_EI_082_14_T=1169345898;
	const FIELD_EI_082_15_S=1169346858;
	const FIELD_EI_082_15_T=1169346859;
	const FIELD_EI_082_16_S=1169347819;
	const FIELD_EI_082_16_T=1169347820;
	const FIELD_EI_082_17_S=1169348780;
	const FIELD_EI_082_17_T=1169348781;
	const FIELD_EI_082_18_S=1169349741;
	const FIELD_EI_082_18_T=1169349742;
	const FIELD_EI_082_19_S=1169350702;
	const FIELD_EI_082_19_T=1169350703;
	const FIELD_EI_082_20_S=1169371844;
	const FIELD_EI_082_20_T=1169371845;
	const FIELD_EI_082_21_S=1169372805;
	const FIELD_EI_082_21_T=1169372806;
	const FIELD_EI_082_22_S=1169373766;
	const FIELD_EI_082_22_T=1169373767;
	const FIELD_EI_082_23_S=1169374727;
	const FIELD_EI_082_23_T=1169374728;
	const FIELD_EI_082_24_S=1169375688;
	const FIELD_EI_082_24_T=1169375689;
	const FIELD_EI_082_25_S=1169376649;
	const FIELD_EI_082_25_T=1169376650;
	const FIELD_EI_082_26_S=1169377610;
	const FIELD_EI_082_26_T=1169377611;
	const FIELD_EI_082_27_S=1169378571;
	const FIELD_EI_082_27_T=1169378572;
	const FIELD_EI_09_01_T=-1694605713;
	private static $PRIMARY_KEYS=array(self::FIELD_EI_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_EI_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_EI_ID=>'ei_id',
		self::FIELD_EI_DATUM=>'ei_datum',
		self::FIELD_EI_01_01_S=>'ei_01_01_s',
		self::FIELD_EI_01_01_T=>'ei_01_01_t',
		self::FIELD_EI_01_02_S=>'ei_01_02_s',
		self::FIELD_EI_01_02_T=>'ei_01_02_t',
		self::FIELD_EI_01_03_S=>'ei_01_03_s',
		self::FIELD_EI_01_03_T=>'ei_01_03_t',
		self::FIELD_EI_01_04_S=>'ei_01_04_s',
		self::FIELD_EI_01_04_T=>'ei_01_04_t',
		self::FIELD_EI_01_05_S=>'ei_01_05_s',
		self::FIELD_EI_01_05_T=>'ei_01_05_t',
		self::FIELD_EI_01_06_S=>'ei_01_06_s',
		self::FIELD_EI_01_06_T=>'ei_01_06_t',
		self::FIELD_EI_01_07_S=>'ei_01_07_s',
		self::FIELD_EI_01_07_T=>'ei_01_07_t',
		self::FIELD_EI_02_01_S=>'ei_02_01_s',
		self::FIELD_EI_02_01_T=>'ei_02_01_t',
		self::FIELD_EI_02_02_S=>'ei_02_02_s',
		self::FIELD_EI_02_02_T=>'ei_02_02_t',
		self::FIELD_EI_02_03_S=>'ei_02_03_s',
		self::FIELD_EI_02_03_T=>'ei_02_03_t',
		self::FIELD_EI_02_04_S=>'ei_02_04_s',
		self::FIELD_EI_02_04_T=>'ei_02_04_t',
		self::FIELD_EI_02_05_S=>'ei_02_05_s',
		self::FIELD_EI_02_05_T=>'ei_02_05_t',
		self::FIELD_EI_02_06_S=>'ei_02_06_s',
		self::FIELD_EI_02_06_T=>'ei_02_06_t',
		self::FIELD_EI_02_07_S=>'ei_02_07_s',
		self::FIELD_EI_02_07_T=>'ei_02_07_t',
		self::FIELD_EI_02_08_S=>'ei_02_08_s',
		self::FIELD_EI_02_08_T=>'ei_02_08_t',
		self::FIELD_EI_02_09_S=>'ei_02_09_s',
		self::FIELD_EI_02_09_T=>'ei_02_09_t',
		self::FIELD_EI_031_01_S=>'ei_031_01_s',
		self::FIELD_EI_031_01_T=>'ei_031_01_t',
		self::FIELD_EI_031_02_S=>'ei_031_02_s',
		self::FIELD_EI_031_02_T=>'ei_031_02_t',
		self::FIELD_EI_031_03_S=>'ei_031_03_s',
		self::FIELD_EI_031_03_T=>'ei_031_03_t',
		self::FIELD_EI_031_04_S=>'ei_031_04_s',
		self::FIELD_EI_031_04_T=>'ei_031_04_t',
		self::FIELD_EI_031_05_S=>'ei_031_05_s',
		self::FIELD_EI_031_05_T=>'ei_031_05_t',
		self::FIELD_EI_031_06_S=>'ei_031_06_s',
		self::FIELD_EI_031_06_T=>'ei_031_06_t',
		self::FIELD_EI_031_07_S=>'ei_031_07_s',
		self::FIELD_EI_031_07_T=>'ei_031_07_t',
		self::FIELD_EI_031_08_S=>'ei_031_08_s',
		self::FIELD_EI_031_08_T=>'ei_031_08_t',
		self::FIELD_EI_032_01_S=>'ei_032_01_s',
		self::FIELD_EI_032_01_T=>'ei_032_01_t',
		self::FIELD_EI_032_02_S=>'ei_032_02_s',
		self::FIELD_EI_032_02_T=>'ei_032_02_t',
		self::FIELD_EI_032_03_S=>'ei_032_03_s',
		self::FIELD_EI_032_03_T=>'ei_032_03_t',
		self::FIELD_EI_032_04_S=>'ei_032_04_s',
		self::FIELD_EI_032_04_T=>'ei_032_04_t',
		self::FIELD_EI_032_05_S=>'ei_032_05_s',
		self::FIELD_EI_032_05_T=>'ei_032_05_t',
		self::FIELD_EI_032_06_S=>'ei_032_06_s',
		self::FIELD_EI_032_06_T=>'ei_032_06_t',
		self::FIELD_EI_032_07_S=>'ei_032_07_s',
		self::FIELD_EI_032_07_T=>'ei_032_07_t',
		self::FIELD_EI_032_08_S=>'ei_032_08_s',
		self::FIELD_EI_032_08_T=>'ei_032_08_t',
		self::FIELD_EI_032_09_S=>'ei_032_09_s',
		self::FIELD_EI_032_09_T=>'ei_032_09_t',
		self::FIELD_EI_032_10_S=>'ei_032_10_s',
		self::FIELD_EI_032_10_T=>'ei_032_10_t',
		self::FIELD_EI_032_11_S=>'ei_032_11_s',
		self::FIELD_EI_032_11_T=>'ei_032_11_t',
		self::FIELD_EI_032_12_S=>'ei_032_12_s',
		self::FIELD_EI_032_12_T=>'ei_032_12_t',
		self::FIELD_EI_032_13_S=>'ei_032_13_s',
		self::FIELD_EI_032_13_T=>'ei_032_13_t',
		self::FIELD_EI_032_14_S=>'ei_032_14_s',
		self::FIELD_EI_032_14_T=>'ei_032_14_t',
		self::FIELD_EI_033_01_S=>'ei_033_01_s',
		self::FIELD_EI_033_01_T=>'ei_033_01_t',
		self::FIELD_EI_033_02_S=>'ei_033_02_s',
		self::FIELD_EI_033_02_T=>'ei_033_02_t',
		self::FIELD_EI_033_03_S=>'ei_033_03_s',
		self::FIELD_EI_033_03_T=>'ei_033_03_t',
		self::FIELD_EI_033_04_S=>'ei_033_04_s',
		self::FIELD_EI_033_04_T=>'ei_033_04_t',
		self::FIELD_EI_033_05_S=>'ei_033_05_s',
		self::FIELD_EI_033_05_T=>'ei_033_05_t',
		self::FIELD_EI_033_06_S=>'ei_033_06_s',
		self::FIELD_EI_033_06_T=>'ei_033_06_t',
		self::FIELD_EI_033_07_S=>'ei_033_07_s',
		self::FIELD_EI_033_07_T=>'ei_033_07_t',
		self::FIELD_EI_033_08_S=>'ei_033_08_s',
		self::FIELD_EI_033_08_T=>'ei_033_08_t',
		self::FIELD_EI_04_01_S=>'ei_04_01_s',
		self::FIELD_EI_04_01_T=>'ei_04_01_t',
		self::FIELD_EI_04_02_S=>'ei_04_02_s',
		self::FIELD_EI_04_02_T=>'ei_04_02_t',
		self::FIELD_EI_04_03_S=>'ei_04_03_s',
		self::FIELD_EI_04_03_T=>'ei_04_03_t',
		self::FIELD_EI_04_04_S=>'ei_04_04_s',
		self::FIELD_EI_04_04_T=>'ei_04_04_t',
		self::FIELD_EI_04_05_S=>'ei_04_05_s',
		self::FIELD_EI_04_05_T=>'ei_04_05_t',
		self::FIELD_EI_04_06_S=>'ei_04_06_s',
		self::FIELD_EI_04_06_T=>'ei_04_06_t',
		self::FIELD_EI_04_07_S=>'ei_04_07_s',
		self::FIELD_EI_04_07_T=>'ei_04_07_t',
		self::FIELD_EI_04_08_S=>'ei_04_08_s',
		self::FIELD_EI_04_08_T=>'ei_04_08_t',
		self::FIELD_EI_04_09_S=>'ei_04_09_s',
		self::FIELD_EI_04_09_T=>'ei_04_09_t',
		self::FIELD_EI_04_10_S=>'ei_04_10_s',
		self::FIELD_EI_04_10_T=>'ei_04_10_t',
		self::FIELD_EI_04_11_S=>'ei_04_11_s',
		self::FIELD_EI_04_11_T=>'ei_04_11_t',
		self::FIELD_EI_04_12_S=>'ei_04_12_s',
		self::FIELD_EI_04_12_T=>'ei_04_12_t',
		self::FIELD_EI_04_13_S=>'ei_04_13_s',
		self::FIELD_EI_04_13_T=>'ei_04_13_t',
		self::FIELD_EI_04_14_S=>'ei_04_14_s',
		self::FIELD_EI_04_14_T=>'ei_04_14_t',
		self::FIELD_EI_05_01_S=>'ei_05_01_s',
		self::FIELD_EI_05_01_T=>'ei_05_01_t',
		self::FIELD_EI_05_02_S=>'ei_05_02_s',
		self::FIELD_EI_05_02_T=>'ei_05_02_t',
		self::FIELD_EI_05_03_S=>'ei_05_03_s',
		self::FIELD_EI_05_03_T=>'ei_05_03_t',
		self::FIELD_EI_05_04_S=>'ei_05_04_s',
		self::FIELD_EI_05_04_T=>'ei_05_04_t',
		self::FIELD_EI_05_05_S=>'ei_05_05_s',
		self::FIELD_EI_05_05_T=>'ei_05_05_t',
		self::FIELD_EI_05_06_S=>'ei_05_06_s',
		self::FIELD_EI_05_06_T=>'ei_05_06_t',
		self::FIELD_EI_05_07_S=>'ei_05_07_s',
		self::FIELD_EI_05_07_T=>'ei_05_07_t',
		self::FIELD_EI_05_08_S=>'ei_05_08_s',
		self::FIELD_EI_05_08_T=>'ei_05_08_t',
		self::FIELD_EI_05_09_S=>'ei_05_09_s',
		self::FIELD_EI_05_09_T=>'ei_05_09_t',
		self::FIELD_EI_05_10_S=>'ei_05_10_s',
		self::FIELD_EI_05_10_T=>'ei_05_10_t',
		self::FIELD_EI_05_11_S=>'ei_05_11_s',
		self::FIELD_EI_05_11_T=>'ei_05_11_t',
		self::FIELD_EI_05_12_S=>'ei_05_12_s',
		self::FIELD_EI_05_12_T=>'ei_05_12_t',
		self::FIELD_EI_05_13_S=>'ei_05_13_s',
		self::FIELD_EI_05_13_T=>'ei_05_13_t',
		self::FIELD_EI_05_14_S=>'ei_05_14_s',
		self::FIELD_EI_05_14_T=>'ei_05_14_t',
		self::FIELD_EI_06_01_S=>'ei_06_01_s',
		self::FIELD_EI_06_01_T=>'ei_06_01_t',
		self::FIELD_EI_06_02_S=>'ei_06_02_s',
		self::FIELD_EI_06_02_T=>'ei_06_02_t',
		self::FIELD_EI_06_03_S=>'ei_06_03_s',
		self::FIELD_EI_06_03_T=>'ei_06_03_t',
		self::FIELD_EI_06_04_S=>'ei_06_04_s',
		self::FIELD_EI_06_04_T=>'ei_06_04_t',
		self::FIELD_EI_06_05_S=>'ei_06_05_s',
		self::FIELD_EI_06_05_T=>'ei_06_05_t',
		self::FIELD_EI_06_06_S=>'ei_06_06_s',
		self::FIELD_EI_06_06_T=>'ei_06_06_t',
		self::FIELD_EI_06_07_S=>'ei_06_07_s',
		self::FIELD_EI_06_07_T=>'ei_06_07_t',
		self::FIELD_EI_06_08_S=>'ei_06_08_s',
		self::FIELD_EI_06_08_T=>'ei_06_08_t',
		self::FIELD_EI_06_09_S=>'ei_06_09_s',
		self::FIELD_EI_06_09_T=>'ei_06_09_t',
		self::FIELD_EI_06_10_S=>'ei_06_10_s',
		self::FIELD_EI_06_10_T=>'ei_06_10_t',
		self::FIELD_EI_06_11_S=>'ei_06_11_s',
		self::FIELD_EI_06_11_T=>'ei_06_11_t',
		self::FIELD_EI_07_01_S=>'ei_07_01_s',
		self::FIELD_EI_07_01_T=>'ei_07_01_t',
		self::FIELD_EI_07_02_S=>'ei_07_02_s',
		self::FIELD_EI_07_02_T=>'ei_07_02_t',
		self::FIELD_EI_07_03_S=>'ei_07_03_s',
		self::FIELD_EI_07_03_T=>'ei_07_03_t',
		self::FIELD_EI_07_04_S=>'ei_07_04_s',
		self::FIELD_EI_07_04_T=>'ei_07_04_t',
		self::FIELD_EI_07_05_S=>'ei_07_05_s',
		self::FIELD_EI_07_05_T=>'ei_07_05_t',
		self::FIELD_EI_07_06_S=>'ei_07_06_s',
		self::FIELD_EI_07_06_T=>'ei_07_06_t',
		self::FIELD_EI_07_07_S=>'ei_07_07_s',
		self::FIELD_EI_07_07_T=>'ei_07_07_t',
		self::FIELD_EI_07_08_S=>'ei_07_08_s',
		self::FIELD_EI_07_08_T=>'ei_07_08_t',
		self::FIELD_EI_081_01_S=>'ei_081_01_s',
		self::FIELD_EI_081_01_T=>'ei_081_01_t',
		self::FIELD_EI_081_02_S=>'ei_081_02_s',
		self::FIELD_EI_081_02_T=>'ei_081_02_t',
		self::FIELD_EI_081_03_S=>'ei_081_03_s',
		self::FIELD_EI_081_03_T=>'ei_081_03_t',
		self::FIELD_EI_081_04_S=>'ei_081_04_s',
		self::FIELD_EI_081_04_T=>'ei_081_04_t',
		self::FIELD_EI_081_05_S=>'ei_081_05_s',
		self::FIELD_EI_081_05_T=>'ei_081_05_t',
		self::FIELD_EI_081_06_S=>'ei_081_06_s',
		self::FIELD_EI_081_06_T=>'ei_081_06_t',
		self::FIELD_EI_081_07_S=>'ei_081_07_s',
		self::FIELD_EI_081_07_T=>'ei_081_07_t',
		self::FIELD_EI_081_08_S=>'ei_081_08_s',
		self::FIELD_EI_081_08_T=>'ei_081_08_t',
		self::FIELD_EI_081_09_S=>'ei_081_09_s',
		self::FIELD_EI_081_09_T=>'ei_081_09_t',
		self::FIELD_EI_081_10_S=>'ei_081_10_s',
		self::FIELD_EI_081_10_T=>'ei_081_10_t',
		self::FIELD_EI_081_11_S=>'ei_081_11_s',
		self::FIELD_EI_081_11_T=>'ei_081_11_t',
		self::FIELD_EI_081_12_S=>'ei_081_12_s',
		self::FIELD_EI_081_12_T=>'ei_081_12_t',
		self::FIELD_EI_081_13_S=>'ei_081_13_s',
		self::FIELD_EI_081_13_T=>'ei_081_13_t',
		self::FIELD_EI_081_14_S=>'ei_081_14_s',
		self::FIELD_EI_081_14_T=>'ei_081_14_t',
		self::FIELD_EI_081_15_S=>'ei_081_15_s',
		self::FIELD_EI_081_15_T=>'ei_081_15_t',
		self::FIELD_EI_081_16_S=>'ei_081_16_s',
		self::FIELD_EI_081_16_T=>'ei_081_16_t',
		self::FIELD_EI_081_17_S=>'ei_081_17_s',
		self::FIELD_EI_081_17_T=>'ei_081_17_t',
		self::FIELD_EI_081_18_S=>'ei_081_18_s',
		self::FIELD_EI_081_18_T=>'ei_081_18_t',
		self::FIELD_EI_081_19_S=>'ei_081_19_s',
		self::FIELD_EI_081_19_T=>'ei_081_19_t',
		self::FIELD_EI_082_01_S=>'ei_082_01_s',
		self::FIELD_EI_082_01_T=>'ei_082_01_t',
		self::FIELD_EI_082_02_S=>'ei_082_02_s',
		self::FIELD_EI_082_02_T=>'ei_082_02_t',
		self::FIELD_EI_082_03_S=>'ei_082_03_s',
		self::FIELD_EI_082_03_T=>'ei_082_03_t',
		self::FIELD_EI_082_04_S=>'ei_082_04_s',
		self::FIELD_EI_082_04_T=>'ei_082_04_t',
		self::FIELD_EI_082_05_S=>'ei_082_05_s',
		self::FIELD_EI_082_05_T=>'ei_082_05_t',
		self::FIELD_EI_082_06_S=>'ei_082_06_s',
		self::FIELD_EI_082_06_T=>'ei_082_06_t',
		self::FIELD_EI_082_07_S=>'ei_082_07_s',
		self::FIELD_EI_082_07_T=>'ei_082_07_t',
		self::FIELD_EI_082_08_S=>'ei_082_08_s',
		self::FIELD_EI_082_08_T=>'ei_082_08_t',
		self::FIELD_EI_082_09_S=>'ei_082_09_s',
		self::FIELD_EI_082_09_T=>'ei_082_09_t',
		self::FIELD_EI_082_10_S=>'ei_082_10_s',
		self::FIELD_EI_082_10_T=>'ei_082_10_t',
		self::FIELD_EI_082_11_S=>'ei_082_11_s',
		self::FIELD_EI_082_11_T=>'ei_082_11_t',
		self::FIELD_EI_082_12_S=>'ei_082_12_s',
		self::FIELD_EI_082_12_T=>'ei_082_12_t',
		self::FIELD_EI_082_13_S=>'ei_082_13_s',
		self::FIELD_EI_082_13_T=>'ei_082_13_t',
		self::FIELD_EI_082_14_S=>'ei_082_14_s',
		self::FIELD_EI_082_14_T=>'ei_082_14_t',
		self::FIELD_EI_082_15_S=>'ei_082_15_s',
		self::FIELD_EI_082_15_T=>'ei_082_15_t',
		self::FIELD_EI_082_16_S=>'ei_082_16_s',
		self::FIELD_EI_082_16_T=>'ei_082_16_t',
		self::FIELD_EI_082_17_S=>'ei_082_17_s',
		self::FIELD_EI_082_17_T=>'ei_082_17_t',
		self::FIELD_EI_082_18_S=>'ei_082_18_s',
		self::FIELD_EI_082_18_T=>'ei_082_18_t',
		self::FIELD_EI_082_19_S=>'ei_082_19_s',
		self::FIELD_EI_082_19_T=>'ei_082_19_t',
		self::FIELD_EI_082_20_S=>'ei_082_20_s',
		self::FIELD_EI_082_20_T=>'ei_082_20_t',
		self::FIELD_EI_082_21_S=>'ei_082_21_s',
		self::FIELD_EI_082_21_T=>'ei_082_21_t',
		self::FIELD_EI_082_22_S=>'ei_082_22_s',
		self::FIELD_EI_082_22_T=>'ei_082_22_t',
		self::FIELD_EI_082_23_S=>'ei_082_23_s',
		self::FIELD_EI_082_23_T=>'ei_082_23_t',
		self::FIELD_EI_082_24_S=>'ei_082_24_s',
		self::FIELD_EI_082_24_T=>'ei_082_24_t',
		self::FIELD_EI_082_25_S=>'ei_082_25_s',
		self::FIELD_EI_082_25_T=>'ei_082_25_t',
		self::FIELD_EI_082_26_S=>'ei_082_26_s',
		self::FIELD_EI_082_26_T=>'ei_082_26_t',
		self::FIELD_EI_082_27_S=>'ei_082_27_s',
		self::FIELD_EI_082_27_T=>'ei_082_27_t',
		self::FIELD_EI_09_01_T=>'ei_09_01_t');
	private static $PROPERTY_NAMES=array(
		self::FIELD_EI_ID=>'eiId',
		self::FIELD_EI_DATUM=>'eiDatum',
		self::FIELD_EI_01_01_S=>'ei0101S',
		self::FIELD_EI_01_01_T=>'ei0101T',
		self::FIELD_EI_01_02_S=>'ei0102S',
		self::FIELD_EI_01_02_T=>'ei0102T',
		self::FIELD_EI_01_03_S=>'ei0103S',
		self::FIELD_EI_01_03_T=>'ei0103T',
		self::FIELD_EI_01_04_S=>'ei0104S',
		self::FIELD_EI_01_04_T=>'ei0104T',
		self::FIELD_EI_01_05_S=>'ei0105S',
		self::FIELD_EI_01_05_T=>'ei0105T',
		self::FIELD_EI_01_06_S=>'ei0106S',
		self::FIELD_EI_01_06_T=>'ei0106T',
		self::FIELD_EI_01_07_S=>'ei0107S',
		self::FIELD_EI_01_07_T=>'ei0107T',
		self::FIELD_EI_02_01_S=>'ei0201S',
		self::FIELD_EI_02_01_T=>'ei0201T',
		self::FIELD_EI_02_02_S=>'ei0202S',
		self::FIELD_EI_02_02_T=>'ei0202T',
		self::FIELD_EI_02_03_S=>'ei0203S',
		self::FIELD_EI_02_03_T=>'ei0203T',
		self::FIELD_EI_02_04_S=>'ei0204S',
		self::FIELD_EI_02_04_T=>'ei0204T',
		self::FIELD_EI_02_05_S=>'ei0205S',
		self::FIELD_EI_02_05_T=>'ei0205T',
		self::FIELD_EI_02_06_S=>'ei0206S',
		self::FIELD_EI_02_06_T=>'ei0206T',
		self::FIELD_EI_02_07_S=>'ei0207S',
		self::FIELD_EI_02_07_T=>'ei0207T',
		self::FIELD_EI_02_08_S=>'ei0208S',
		self::FIELD_EI_02_08_T=>'ei0208T',
		self::FIELD_EI_02_09_S=>'ei0209S',
		self::FIELD_EI_02_09_T=>'ei0209T',
		self::FIELD_EI_031_01_S=>'ei03101S',
		self::FIELD_EI_031_01_T=>'ei03101T',
		self::FIELD_EI_031_02_S=>'ei03102S',
		self::FIELD_EI_031_02_T=>'ei03102T',
		self::FIELD_EI_031_03_S=>'ei03103S',
		self::FIELD_EI_031_03_T=>'ei03103T',
		self::FIELD_EI_031_04_S=>'ei03104S',
		self::FIELD_EI_031_04_T=>'ei03104T',
		self::FIELD_EI_031_05_S=>'ei03105S',
		self::FIELD_EI_031_05_T=>'ei03105T',
		self::FIELD_EI_031_06_S=>'ei03106S',
		self::FIELD_EI_031_06_T=>'ei03106T',
		self::FIELD_EI_031_07_S=>'ei03107S',
		self::FIELD_EI_031_07_T=>'ei03107T',
		self::FIELD_EI_031_08_S=>'ei03108S',
		self::FIELD_EI_031_08_T=>'ei03108T',
		self::FIELD_EI_032_01_S=>'ei03201S',
		self::FIELD_EI_032_01_T=>'ei03201T',
		self::FIELD_EI_032_02_S=>'ei03202S',
		self::FIELD_EI_032_02_T=>'ei03202T',
		self::FIELD_EI_032_03_S=>'ei03203S',
		self::FIELD_EI_032_03_T=>'ei03203T',
		self::FIELD_EI_032_04_S=>'ei03204S',
		self::FIELD_EI_032_04_T=>'ei03204T',
		self::FIELD_EI_032_05_S=>'ei03205S',
		self::FIELD_EI_032_05_T=>'ei03205T',
		self::FIELD_EI_032_06_S=>'ei03206S',
		self::FIELD_EI_032_06_T=>'ei03206T',
		self::FIELD_EI_032_07_S=>'ei03207S',
		self::FIELD_EI_032_07_T=>'ei03207T',
		self::FIELD_EI_032_08_S=>'ei03208S',
		self::FIELD_EI_032_08_T=>'ei03208T',
		self::FIELD_EI_032_09_S=>'ei03209S',
		self::FIELD_EI_032_09_T=>'ei03209T',
		self::FIELD_EI_032_10_S=>'ei03210S',
		self::FIELD_EI_032_10_T=>'ei03210T',
		self::FIELD_EI_032_11_S=>'ei03211S',
		self::FIELD_EI_032_11_T=>'ei03211T',
		self::FIELD_EI_032_12_S=>'ei03212S',
		self::FIELD_EI_032_12_T=>'ei03212T',
		self::FIELD_EI_032_13_S=>'ei03213S',
		self::FIELD_EI_032_13_T=>'ei03213T',
		self::FIELD_EI_032_14_S=>'ei03214S',
		self::FIELD_EI_032_14_T=>'ei03214T',
		self::FIELD_EI_033_01_S=>'ei03301S',
		self::FIELD_EI_033_01_T=>'ei03301T',
		self::FIELD_EI_033_02_S=>'ei03302S',
		self::FIELD_EI_033_02_T=>'ei03302T',
		self::FIELD_EI_033_03_S=>'ei03303S',
		self::FIELD_EI_033_03_T=>'ei03303T',
		self::FIELD_EI_033_04_S=>'ei03304S',
		self::FIELD_EI_033_04_T=>'ei03304T',
		self::FIELD_EI_033_05_S=>'ei03305S',
		self::FIELD_EI_033_05_T=>'ei03305T',
		self::FIELD_EI_033_06_S=>'ei03306S',
		self::FIELD_EI_033_06_T=>'ei03306T',
		self::FIELD_EI_033_07_S=>'ei03307S',
		self::FIELD_EI_033_07_T=>'ei03307T',
		self::FIELD_EI_033_08_S=>'ei03308S',
		self::FIELD_EI_033_08_T=>'ei03308T',
		self::FIELD_EI_04_01_S=>'ei0401S',
		self::FIELD_EI_04_01_T=>'ei0401T',
		self::FIELD_EI_04_02_S=>'ei0402S',
		self::FIELD_EI_04_02_T=>'ei0402T',
		self::FIELD_EI_04_03_S=>'ei0403S',
		self::FIELD_EI_04_03_T=>'ei0403T',
		self::FIELD_EI_04_04_S=>'ei0404S',
		self::FIELD_EI_04_04_T=>'ei0404T',
		self::FIELD_EI_04_05_S=>'ei0405S',
		self::FIELD_EI_04_05_T=>'ei0405T',
		self::FIELD_EI_04_06_S=>'ei0406S',
		self::FIELD_EI_04_06_T=>'ei0406T',
		self::FIELD_EI_04_07_S=>'ei0407S',
		self::FIELD_EI_04_07_T=>'ei0407T',
		self::FIELD_EI_04_08_S=>'ei0408S',
		self::FIELD_EI_04_08_T=>'ei0408T',
		self::FIELD_EI_04_09_S=>'ei0409S',
		self::FIELD_EI_04_09_T=>'ei0409T',
		self::FIELD_EI_04_10_S=>'ei0410S',
		self::FIELD_EI_04_10_T=>'ei0410T',
		self::FIELD_EI_04_11_S=>'ei0411S',
		self::FIELD_EI_04_11_T=>'ei0411T',
		self::FIELD_EI_04_12_S=>'ei0412S',
		self::FIELD_EI_04_12_T=>'ei0412T',
		self::FIELD_EI_04_13_S=>'ei0413S',
		self::FIELD_EI_04_13_T=>'ei0413T',
		self::FIELD_EI_04_14_S=>'ei0414S',
		self::FIELD_EI_04_14_T=>'ei0414T',
		self::FIELD_EI_05_01_S=>'ei0501S',
		self::FIELD_EI_05_01_T=>'ei0501T',
		self::FIELD_EI_05_02_S=>'ei0502S',
		self::FIELD_EI_05_02_T=>'ei0502T',
		self::FIELD_EI_05_03_S=>'ei0503S',
		self::FIELD_EI_05_03_T=>'ei0503T',
		self::FIELD_EI_05_04_S=>'ei0504S',
		self::FIELD_EI_05_04_T=>'ei0504T',
		self::FIELD_EI_05_05_S=>'ei0505S',
		self::FIELD_EI_05_05_T=>'ei0505T',
		self::FIELD_EI_05_06_S=>'ei0506S',
		self::FIELD_EI_05_06_T=>'ei0506T',
		self::FIELD_EI_05_07_S=>'ei0507S',
		self::FIELD_EI_05_07_T=>'ei0507T',
		self::FIELD_EI_05_08_S=>'ei0508S',
		self::FIELD_EI_05_08_T=>'ei0508T',
		self::FIELD_EI_05_09_S=>'ei0509S',
		self::FIELD_EI_05_09_T=>'ei0509T',
		self::FIELD_EI_05_10_S=>'ei0510S',
		self::FIELD_EI_05_10_T=>'ei0510T',
		self::FIELD_EI_05_11_S=>'ei0511S',
		self::FIELD_EI_05_11_T=>'ei0511T',
		self::FIELD_EI_05_12_S=>'ei0512S',
		self::FIELD_EI_05_12_T=>'ei0512T',
		self::FIELD_EI_05_13_S=>'ei0513S',
		self::FIELD_EI_05_13_T=>'ei0513T',
		self::FIELD_EI_05_14_S=>'ei0514S',
		self::FIELD_EI_05_14_T=>'ei0514T',
		self::FIELD_EI_06_01_S=>'ei0601S',
		self::FIELD_EI_06_01_T=>'ei0601T',
		self::FIELD_EI_06_02_S=>'ei0602S',
		self::FIELD_EI_06_02_T=>'ei0602T',
		self::FIELD_EI_06_03_S=>'ei0603S',
		self::FIELD_EI_06_03_T=>'ei0603T',
		self::FIELD_EI_06_04_S=>'ei0604S',
		self::FIELD_EI_06_04_T=>'ei0604T',
		self::FIELD_EI_06_05_S=>'ei0605S',
		self::FIELD_EI_06_05_T=>'ei0605T',
		self::FIELD_EI_06_06_S=>'ei0606S',
		self::FIELD_EI_06_06_T=>'ei0606T',
		self::FIELD_EI_06_07_S=>'ei0607S',
		self::FIELD_EI_06_07_T=>'ei0607T',
		self::FIELD_EI_06_08_S=>'ei0608S',
		self::FIELD_EI_06_08_T=>'ei0608T',
		self::FIELD_EI_06_09_S=>'ei0609S',
		self::FIELD_EI_06_09_T=>'ei0609T',
		self::FIELD_EI_06_10_S=>'ei0610S',
		self::FIELD_EI_06_10_T=>'ei0610T',
		self::FIELD_EI_06_11_S=>'ei0611S',
		self::FIELD_EI_06_11_T=>'ei0611T',
		self::FIELD_EI_07_01_S=>'ei0701S',
		self::FIELD_EI_07_01_T=>'ei0701T',
		self::FIELD_EI_07_02_S=>'ei0702S',
		self::FIELD_EI_07_02_T=>'ei0702T',
		self::FIELD_EI_07_03_S=>'ei0703S',
		self::FIELD_EI_07_03_T=>'ei0703T',
		self::FIELD_EI_07_04_S=>'ei0704S',
		self::FIELD_EI_07_04_T=>'ei0704T',
		self::FIELD_EI_07_05_S=>'ei0705S',
		self::FIELD_EI_07_05_T=>'ei0705T',
		self::FIELD_EI_07_06_S=>'ei0706S',
		self::FIELD_EI_07_06_T=>'ei0706T',
		self::FIELD_EI_07_07_S=>'ei0707S',
		self::FIELD_EI_07_07_T=>'ei0707T',
		self::FIELD_EI_07_08_S=>'ei0708S',
		self::FIELD_EI_07_08_T=>'ei0708T',
		self::FIELD_EI_081_01_S=>'ei08101S',
		self::FIELD_EI_081_01_T=>'ei08101T',
		self::FIELD_EI_081_02_S=>'ei08102S',
		self::FIELD_EI_081_02_T=>'ei08102T',
		self::FIELD_EI_081_03_S=>'ei08103S',
		self::FIELD_EI_081_03_T=>'ei08103T',
		self::FIELD_EI_081_04_S=>'ei08104S',
		self::FIELD_EI_081_04_T=>'ei08104T',
		self::FIELD_EI_081_05_S=>'ei08105S',
		self::FIELD_EI_081_05_T=>'ei08105T',
		self::FIELD_EI_081_06_S=>'ei08106S',
		self::FIELD_EI_081_06_T=>'ei08106T',
		self::FIELD_EI_081_07_S=>'ei08107S',
		self::FIELD_EI_081_07_T=>'ei08107T',
		self::FIELD_EI_081_08_S=>'ei08108S',
		self::FIELD_EI_081_08_T=>'ei08108T',
		self::FIELD_EI_081_09_S=>'ei08109S',
		self::FIELD_EI_081_09_T=>'ei08109T',
		self::FIELD_EI_081_10_S=>'ei08110S',
		self::FIELD_EI_081_10_T=>'ei08110T',
		self::FIELD_EI_081_11_S=>'ei08111S',
		self::FIELD_EI_081_11_T=>'ei08111T',
		self::FIELD_EI_081_12_S=>'ei08112S',
		self::FIELD_EI_081_12_T=>'ei08112T',
		self::FIELD_EI_081_13_S=>'ei08113S',
		self::FIELD_EI_081_13_T=>'ei08113T',
		self::FIELD_EI_081_14_S=>'ei08114S',
		self::FIELD_EI_081_14_T=>'ei08114T',
		self::FIELD_EI_081_15_S=>'ei08115S',
		self::FIELD_EI_081_15_T=>'ei08115T',
		self::FIELD_EI_081_16_S=>'ei08116S',
		self::FIELD_EI_081_16_T=>'ei08116T',
		self::FIELD_EI_081_17_S=>'ei08117S',
		self::FIELD_EI_081_17_T=>'ei08117T',
		self::FIELD_EI_081_18_S=>'ei08118S',
		self::FIELD_EI_081_18_T=>'ei08118T',
		self::FIELD_EI_081_19_S=>'ei08119S',
		self::FIELD_EI_081_19_T=>'ei08119T',
		self::FIELD_EI_082_01_S=>'ei08201S',
		self::FIELD_EI_082_01_T=>'ei08201T',
		self::FIELD_EI_082_02_S=>'ei08202S',
		self::FIELD_EI_082_02_T=>'ei08202T',
		self::FIELD_EI_082_03_S=>'ei08203S',
		self::FIELD_EI_082_03_T=>'ei08203T',
		self::FIELD_EI_082_04_S=>'ei08204S',
		self::FIELD_EI_082_04_T=>'ei08204T',
		self::FIELD_EI_082_05_S=>'ei08205S',
		self::FIELD_EI_082_05_T=>'ei08205T',
		self::FIELD_EI_082_06_S=>'ei08206S',
		self::FIELD_EI_082_06_T=>'ei08206T',
		self::FIELD_EI_082_07_S=>'ei08207S',
		self::FIELD_EI_082_07_T=>'ei08207T',
		self::FIELD_EI_082_08_S=>'ei08208S',
		self::FIELD_EI_082_08_T=>'ei08208T',
		self::FIELD_EI_082_09_S=>'ei08209S',
		self::FIELD_EI_082_09_T=>'ei08209T',
		self::FIELD_EI_082_10_S=>'ei08210S',
		self::FIELD_EI_082_10_T=>'ei08210T',
		self::FIELD_EI_082_11_S=>'ei08211S',
		self::FIELD_EI_082_11_T=>'ei08211T',
		self::FIELD_EI_082_12_S=>'ei08212S',
		self::FIELD_EI_082_12_T=>'ei08212T',
		self::FIELD_EI_082_13_S=>'ei08213S',
		self::FIELD_EI_082_13_T=>'ei08213T',
		self::FIELD_EI_082_14_S=>'ei08214S',
		self::FIELD_EI_082_14_T=>'ei08214T',
		self::FIELD_EI_082_15_S=>'ei08215S',
		self::FIELD_EI_082_15_T=>'ei08215T',
		self::FIELD_EI_082_16_S=>'ei08216S',
		self::FIELD_EI_082_16_T=>'ei08216T',
		self::FIELD_EI_082_17_S=>'ei08217S',
		self::FIELD_EI_082_17_T=>'ei08217T',
		self::FIELD_EI_082_18_S=>'ei08218S',
		self::FIELD_EI_082_18_T=>'ei08218T',
		self::FIELD_EI_082_19_S=>'ei08219S',
		self::FIELD_EI_082_19_T=>'ei08219T',
		self::FIELD_EI_082_20_S=>'ei08220S',
		self::FIELD_EI_082_20_T=>'ei08220T',
		self::FIELD_EI_082_21_S=>'ei08221S',
		self::FIELD_EI_082_21_T=>'ei08221T',
		self::FIELD_EI_082_22_S=>'ei08222S',
		self::FIELD_EI_082_22_T=>'ei08222T',
		self::FIELD_EI_082_23_S=>'ei08223S',
		self::FIELD_EI_082_23_T=>'ei08223T',
		self::FIELD_EI_082_24_S=>'ei08224S',
		self::FIELD_EI_082_24_T=>'ei08224T',
		self::FIELD_EI_082_25_S=>'ei08225S',
		self::FIELD_EI_082_25_T=>'ei08225T',
		self::FIELD_EI_082_26_S=>'ei08226S',
		self::FIELD_EI_082_26_T=>'ei08226T',
		self::FIELD_EI_082_27_S=>'ei08227S',
		self::FIELD_EI_082_27_T=>'ei08227T',
		self::FIELD_EI_09_01_T=>'ei0901T');
	private static $PROPERTY_TYPES=array(
		self::FIELD_EI_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_DATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_01_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_01_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_01_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_01_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_01_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_01_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_01_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_01_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_01_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_01_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_01_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_01_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_01_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_01_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_02_09_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_02_09_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_031_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_031_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_031_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_031_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_031_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_031_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_031_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_031_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_031_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_031_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_031_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_031_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_031_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_031_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_031_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_031_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_09_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_09_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_10_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_10_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_11_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_11_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_12_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_12_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_13_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_13_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_032_14_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_032_14_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_033_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_033_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_033_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_033_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_033_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_033_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_033_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_033_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_033_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_033_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_033_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_033_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_033_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_033_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_033_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_033_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_09_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_09_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_10_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_10_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_11_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_11_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_12_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_12_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_13_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_13_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_04_14_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_04_14_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_09_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_09_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_10_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_10_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_11_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_11_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_12_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_12_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_13_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_13_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_05_14_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_05_14_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_09_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_09_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_10_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_10_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_06_11_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_06_11_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_07_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_07_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_07_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_07_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_07_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_07_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_07_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_07_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_07_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_07_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_07_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_07_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_07_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_07_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_07_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_07_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_09_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_09_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_10_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_10_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_11_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_11_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_12_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_12_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_13_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_13_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_14_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_14_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_15_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_15_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_16_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_16_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_17_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_17_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_18_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_18_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_081_19_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_081_19_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_01_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_01_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_02_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_02_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_03_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_03_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_04_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_04_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_05_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_05_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_06_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_06_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_07_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_07_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_08_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_08_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_09_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_09_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_10_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_10_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_11_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_11_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_12_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_12_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_13_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_13_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_14_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_14_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_15_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_15_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_16_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_16_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_17_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_17_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_18_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_18_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_19_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_19_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_20_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_20_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_21_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_21_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_22_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_22_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_23_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_23_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_24_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_24_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_25_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_25_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_26_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_26_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_082_27_S=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EI_082_27_T=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EI_09_01_T=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_EI_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_DATUM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,30,0,false),
		self::FIELD_EI_01_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_01_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_01_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_01_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_01_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_01_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_01_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_01_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_01_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_01_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_01_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_01_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_01_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_01_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_02_09_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_02_09_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_031_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_031_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_031_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_031_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_031_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_031_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_031_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_031_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_031_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_031_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_031_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_031_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_031_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_031_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_031_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_031_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_09_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_09_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_10_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_10_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_11_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_11_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_12_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_12_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_13_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_13_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_032_14_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_032_14_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_033_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_033_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_033_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_033_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_033_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_033_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_033_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_033_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_033_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_033_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_033_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_033_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_033_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_033_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_033_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_033_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_09_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_09_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_10_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_10_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_11_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_11_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_12_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_12_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_13_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_13_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_04_14_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_04_14_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_09_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_09_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_10_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_10_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_11_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_11_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_12_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_12_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_13_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_13_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_05_14_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_05_14_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_09_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_09_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_10_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_10_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_06_11_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_06_11_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_07_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_07_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_07_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_07_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_07_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_07_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_07_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_07_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_07_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_07_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_07_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_07_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_07_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_07_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_07_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_07_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_09_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_09_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_10_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_10_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_11_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_11_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_12_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_12_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_13_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_13_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_14_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_14_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_15_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_15_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_16_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_16_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_17_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_17_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_18_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_18_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_081_19_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_081_19_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_01_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_01_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_02_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_02_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_03_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_03_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_04_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_04_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_05_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_05_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_06_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_06_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_07_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_07_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_08_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_08_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_09_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_09_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_10_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_10_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_11_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_11_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_12_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_12_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_13_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_13_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_14_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_14_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_15_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_15_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_16_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_16_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_17_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_17_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_18_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_18_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_19_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_19_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_20_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_20_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_21_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_21_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_22_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_22_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_23_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_23_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_24_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_24_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_25_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_25_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_26_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_26_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_082_27_S=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EI_082_27_T=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_EI_09_01_T=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_EI_ID=>null,
		self::FIELD_EI_DATUM=>'0',
		self::FIELD_EI_01_01_S=>0,
		self::FIELD_EI_01_01_T=>'',
		self::FIELD_EI_01_02_S=>0,
		self::FIELD_EI_01_02_T=>'',
		self::FIELD_EI_01_03_S=>0,
		self::FIELD_EI_01_03_T=>'',
		self::FIELD_EI_01_04_S=>0,
		self::FIELD_EI_01_04_T=>'',
		self::FIELD_EI_01_05_S=>0,
		self::FIELD_EI_01_05_T=>'',
		self::FIELD_EI_01_06_S=>0,
		self::FIELD_EI_01_06_T=>'',
		self::FIELD_EI_01_07_S=>0,
		self::FIELD_EI_01_07_T=>'',
		self::FIELD_EI_02_01_S=>0,
		self::FIELD_EI_02_01_T=>'',
		self::FIELD_EI_02_02_S=>0,
		self::FIELD_EI_02_02_T=>'',
		self::FIELD_EI_02_03_S=>0,
		self::FIELD_EI_02_03_T=>'',
		self::FIELD_EI_02_04_S=>0,
		self::FIELD_EI_02_04_T=>'',
		self::FIELD_EI_02_05_S=>0,
		self::FIELD_EI_02_05_T=>'',
		self::FIELD_EI_02_06_S=>0,
		self::FIELD_EI_02_06_T=>'',
		self::FIELD_EI_02_07_S=>0,
		self::FIELD_EI_02_07_T=>'',
		self::FIELD_EI_02_08_S=>0,
		self::FIELD_EI_02_08_T=>'',
		self::FIELD_EI_02_09_S=>0,
		self::FIELD_EI_02_09_T=>'',
		self::FIELD_EI_031_01_S=>0,
		self::FIELD_EI_031_01_T=>'',
		self::FIELD_EI_031_02_S=>0,
		self::FIELD_EI_031_02_T=>'',
		self::FIELD_EI_031_03_S=>0,
		self::FIELD_EI_031_03_T=>'',
		self::FIELD_EI_031_04_S=>0,
		self::FIELD_EI_031_04_T=>'',
		self::FIELD_EI_031_05_S=>0,
		self::FIELD_EI_031_05_T=>'',
		self::FIELD_EI_031_06_S=>0,
		self::FIELD_EI_031_06_T=>'',
		self::FIELD_EI_031_07_S=>0,
		self::FIELD_EI_031_07_T=>'',
		self::FIELD_EI_031_08_S=>0,
		self::FIELD_EI_031_08_T=>'',
		self::FIELD_EI_032_01_S=>0,
		self::FIELD_EI_032_01_T=>'',
		self::FIELD_EI_032_02_S=>0,
		self::FIELD_EI_032_02_T=>'',
		self::FIELD_EI_032_03_S=>0,
		self::FIELD_EI_032_03_T=>'',
		self::FIELD_EI_032_04_S=>0,
		self::FIELD_EI_032_04_T=>'',
		self::FIELD_EI_032_05_S=>0,
		self::FIELD_EI_032_05_T=>'',
		self::FIELD_EI_032_06_S=>0,
		self::FIELD_EI_032_06_T=>'',
		self::FIELD_EI_032_07_S=>0,
		self::FIELD_EI_032_07_T=>'',
		self::FIELD_EI_032_08_S=>0,
		self::FIELD_EI_032_08_T=>'',
		self::FIELD_EI_032_09_S=>0,
		self::FIELD_EI_032_09_T=>'',
		self::FIELD_EI_032_10_S=>0,
		self::FIELD_EI_032_10_T=>'',
		self::FIELD_EI_032_11_S=>0,
		self::FIELD_EI_032_11_T=>'',
		self::FIELD_EI_032_12_S=>0,
		self::FIELD_EI_032_12_T=>'',
		self::FIELD_EI_032_13_S=>0,
		self::FIELD_EI_032_13_T=>'',
		self::FIELD_EI_032_14_S=>0,
		self::FIELD_EI_032_14_T=>'',
		self::FIELD_EI_033_01_S=>0,
		self::FIELD_EI_033_01_T=>'',
		self::FIELD_EI_033_02_S=>0,
		self::FIELD_EI_033_02_T=>'',
		self::FIELD_EI_033_03_S=>0,
		self::FIELD_EI_033_03_T=>'',
		self::FIELD_EI_033_04_S=>0,
		self::FIELD_EI_033_04_T=>'',
		self::FIELD_EI_033_05_S=>0,
		self::FIELD_EI_033_05_T=>'',
		self::FIELD_EI_033_06_S=>0,
		self::FIELD_EI_033_06_T=>'',
		self::FIELD_EI_033_07_S=>0,
		self::FIELD_EI_033_07_T=>'',
		self::FIELD_EI_033_08_S=>0,
		self::FIELD_EI_033_08_T=>'',
		self::FIELD_EI_04_01_S=>0,
		self::FIELD_EI_04_01_T=>'',
		self::FIELD_EI_04_02_S=>0,
		self::FIELD_EI_04_02_T=>'',
		self::FIELD_EI_04_03_S=>0,
		self::FIELD_EI_04_03_T=>'',
		self::FIELD_EI_04_04_S=>0,
		self::FIELD_EI_04_04_T=>'',
		self::FIELD_EI_04_05_S=>0,
		self::FIELD_EI_04_05_T=>'',
		self::FIELD_EI_04_06_S=>0,
		self::FIELD_EI_04_06_T=>'',
		self::FIELD_EI_04_07_S=>0,
		self::FIELD_EI_04_07_T=>'',
		self::FIELD_EI_04_08_S=>0,
		self::FIELD_EI_04_08_T=>'',
		self::FIELD_EI_04_09_S=>0,
		self::FIELD_EI_04_09_T=>'',
		self::FIELD_EI_04_10_S=>0,
		self::FIELD_EI_04_10_T=>'',
		self::FIELD_EI_04_11_S=>0,
		self::FIELD_EI_04_11_T=>'',
		self::FIELD_EI_04_12_S=>0,
		self::FIELD_EI_04_12_T=>'',
		self::FIELD_EI_04_13_S=>0,
		self::FIELD_EI_04_13_T=>'',
		self::FIELD_EI_04_14_S=>0,
		self::FIELD_EI_04_14_T=>'',
		self::FIELD_EI_05_01_S=>0,
		self::FIELD_EI_05_01_T=>'',
		self::FIELD_EI_05_02_S=>0,
		self::FIELD_EI_05_02_T=>'',
		self::FIELD_EI_05_03_S=>0,
		self::FIELD_EI_05_03_T=>'',
		self::FIELD_EI_05_04_S=>0,
		self::FIELD_EI_05_04_T=>'',
		self::FIELD_EI_05_05_S=>0,
		self::FIELD_EI_05_05_T=>'',
		self::FIELD_EI_05_06_S=>0,
		self::FIELD_EI_05_06_T=>'',
		self::FIELD_EI_05_07_S=>0,
		self::FIELD_EI_05_07_T=>'',
		self::FIELD_EI_05_08_S=>0,
		self::FIELD_EI_05_08_T=>'',
		self::FIELD_EI_05_09_S=>0,
		self::FIELD_EI_05_09_T=>'',
		self::FIELD_EI_05_10_S=>0,
		self::FIELD_EI_05_10_T=>'',
		self::FIELD_EI_05_11_S=>0,
		self::FIELD_EI_05_11_T=>'',
		self::FIELD_EI_05_12_S=>0,
		self::FIELD_EI_05_12_T=>'',
		self::FIELD_EI_05_13_S=>0,
		self::FIELD_EI_05_13_T=>'',
		self::FIELD_EI_05_14_S=>0,
		self::FIELD_EI_05_14_T=>'',
		self::FIELD_EI_06_01_S=>0,
		self::FIELD_EI_06_01_T=>'',
		self::FIELD_EI_06_02_S=>0,
		self::FIELD_EI_06_02_T=>'',
		self::FIELD_EI_06_03_S=>0,
		self::FIELD_EI_06_03_T=>'',
		self::FIELD_EI_06_04_S=>0,
		self::FIELD_EI_06_04_T=>'',
		self::FIELD_EI_06_05_S=>0,
		self::FIELD_EI_06_05_T=>'',
		self::FIELD_EI_06_06_S=>0,
		self::FIELD_EI_06_06_T=>'',
		self::FIELD_EI_06_07_S=>0,
		self::FIELD_EI_06_07_T=>'',
		self::FIELD_EI_06_08_S=>0,
		self::FIELD_EI_06_08_T=>'',
		self::FIELD_EI_06_09_S=>0,
		self::FIELD_EI_06_09_T=>'',
		self::FIELD_EI_06_10_S=>0,
		self::FIELD_EI_06_10_T=>'',
		self::FIELD_EI_06_11_S=>0,
		self::FIELD_EI_06_11_T=>'',
		self::FIELD_EI_07_01_S=>0,
		self::FIELD_EI_07_01_T=>'',
		self::FIELD_EI_07_02_S=>0,
		self::FIELD_EI_07_02_T=>'',
		self::FIELD_EI_07_03_S=>0,
		self::FIELD_EI_07_03_T=>'',
		self::FIELD_EI_07_04_S=>0,
		self::FIELD_EI_07_04_T=>'',
		self::FIELD_EI_07_05_S=>0,
		self::FIELD_EI_07_05_T=>'',
		self::FIELD_EI_07_06_S=>0,
		self::FIELD_EI_07_06_T=>'',
		self::FIELD_EI_07_07_S=>0,
		self::FIELD_EI_07_07_T=>'',
		self::FIELD_EI_07_08_S=>0,
		self::FIELD_EI_07_08_T=>'',
		self::FIELD_EI_081_01_S=>0,
		self::FIELD_EI_081_01_T=>'',
		self::FIELD_EI_081_02_S=>0,
		self::FIELD_EI_081_02_T=>'',
		self::FIELD_EI_081_03_S=>0,
		self::FIELD_EI_081_03_T=>'',
		self::FIELD_EI_081_04_S=>0,
		self::FIELD_EI_081_04_T=>'',
		self::FIELD_EI_081_05_S=>0,
		self::FIELD_EI_081_05_T=>'',
		self::FIELD_EI_081_06_S=>0,
		self::FIELD_EI_081_06_T=>'',
		self::FIELD_EI_081_07_S=>0,
		self::FIELD_EI_081_07_T=>'',
		self::FIELD_EI_081_08_S=>0,
		self::FIELD_EI_081_08_T=>'',
		self::FIELD_EI_081_09_S=>0,
		self::FIELD_EI_081_09_T=>'',
		self::FIELD_EI_081_10_S=>0,
		self::FIELD_EI_081_10_T=>'',
		self::FIELD_EI_081_11_S=>0,
		self::FIELD_EI_081_11_T=>'',
		self::FIELD_EI_081_12_S=>0,
		self::FIELD_EI_081_12_T=>'',
		self::FIELD_EI_081_13_S=>0,
		self::FIELD_EI_081_13_T=>'',
		self::FIELD_EI_081_14_S=>0,
		self::FIELD_EI_081_14_T=>'',
		self::FIELD_EI_081_15_S=>0,
		self::FIELD_EI_081_15_T=>'',
		self::FIELD_EI_081_16_S=>0,
		self::FIELD_EI_081_16_T=>'',
		self::FIELD_EI_081_17_S=>0,
		self::FIELD_EI_081_17_T=>'',
		self::FIELD_EI_081_18_S=>0,
		self::FIELD_EI_081_18_T=>'',
		self::FIELD_EI_081_19_S=>0,
		self::FIELD_EI_081_19_T=>'',
		self::FIELD_EI_082_01_S=>0,
		self::FIELD_EI_082_01_T=>'',
		self::FIELD_EI_082_02_S=>0,
		self::FIELD_EI_082_02_T=>'',
		self::FIELD_EI_082_03_S=>0,
		self::FIELD_EI_082_03_T=>'',
		self::FIELD_EI_082_04_S=>0,
		self::FIELD_EI_082_04_T=>'',
		self::FIELD_EI_082_05_S=>0,
		self::FIELD_EI_082_05_T=>'',
		self::FIELD_EI_082_06_S=>0,
		self::FIELD_EI_082_06_T=>'',
		self::FIELD_EI_082_07_S=>0,
		self::FIELD_EI_082_07_T=>'',
		self::FIELD_EI_082_08_S=>0,
		self::FIELD_EI_082_08_T=>'',
		self::FIELD_EI_082_09_S=>0,
		self::FIELD_EI_082_09_T=>'',
		self::FIELD_EI_082_10_S=>0,
		self::FIELD_EI_082_10_T=>'',
		self::FIELD_EI_082_11_S=>0,
		self::FIELD_EI_082_11_T=>'',
		self::FIELD_EI_082_12_S=>0,
		self::FIELD_EI_082_12_T=>'',
		self::FIELD_EI_082_13_S=>0,
		self::FIELD_EI_082_13_T=>'',
		self::FIELD_EI_082_14_S=>0,
		self::FIELD_EI_082_14_T=>'',
		self::FIELD_EI_082_15_S=>0,
		self::FIELD_EI_082_15_T=>'',
		self::FIELD_EI_082_16_S=>0,
		self::FIELD_EI_082_16_T=>'',
		self::FIELD_EI_082_17_S=>0,
		self::FIELD_EI_082_17_T=>'',
		self::FIELD_EI_082_18_S=>0,
		self::FIELD_EI_082_18_T=>'',
		self::FIELD_EI_082_19_S=>0,
		self::FIELD_EI_082_19_T=>'',
		self::FIELD_EI_082_20_S=>0,
		self::FIELD_EI_082_20_T=>'',
		self::FIELD_EI_082_21_S=>0,
		self::FIELD_EI_082_21_T=>'',
		self::FIELD_EI_082_22_S=>0,
		self::FIELD_EI_082_22_T=>'',
		self::FIELD_EI_082_23_S=>0,
		self::FIELD_EI_082_23_T=>'',
		self::FIELD_EI_082_24_S=>0,
		self::FIELD_EI_082_24_T=>'',
		self::FIELD_EI_082_25_S=>0,
		self::FIELD_EI_082_25_T=>'',
		self::FIELD_EI_082_26_S=>0,
		self::FIELD_EI_082_26_T=>'',
		self::FIELD_EI_082_27_S=>0,
		self::FIELD_EI_082_27_T=>'',
		self::FIELD_EI_09_01_T=>'');
	private $eiId;
	private $eiDatum;
	private $ei0101S;
	private $ei0101T;
	private $ei0102S;
	private $ei0102T;
	private $ei0103S;
	private $ei0103T;
	private $ei0104S;
	private $ei0104T;
	private $ei0105S;
	private $ei0105T;
	private $ei0106S;
	private $ei0106T;
	private $ei0107S;
	private $ei0107T;
	private $ei0201S;
	private $ei0201T;
	private $ei0202S;
	private $ei0202T;
	private $ei0203S;
	private $ei0203T;
	private $ei0204S;
	private $ei0204T;
	private $ei0205S;
	private $ei0205T;
	private $ei0206S;
	private $ei0206T;
	private $ei0207S;
	private $ei0207T;
	private $ei0208S;
	private $ei0208T;
	private $ei0209S;
	private $ei0209T;
	private $ei03101S;
	private $ei03101T;
	private $ei03102S;
	private $ei03102T;
	private $ei03103S;
	private $ei03103T;
	private $ei03104S;
	private $ei03104T;
	private $ei03105S;
	private $ei03105T;
	private $ei03106S;
	private $ei03106T;
	private $ei03107S;
	private $ei03107T;
	private $ei03108S;
	private $ei03108T;
	private $ei03201S;
	private $ei03201T;
	private $ei03202S;
	private $ei03202T;
	private $ei03203S;
	private $ei03203T;
	private $ei03204S;
	private $ei03204T;
	private $ei03205S;
	private $ei03205T;
	private $ei03206S;
	private $ei03206T;
	private $ei03207S;
	private $ei03207T;
	private $ei03208S;
	private $ei03208T;
	private $ei03209S;
	private $ei03209T;
	private $ei03210S;
	private $ei03210T;
	private $ei03211S;
	private $ei03211T;
	private $ei03212S;
	private $ei03212T;
	private $ei03213S;
	private $ei03213T;
	private $ei03214S;
	private $ei03214T;
	private $ei03301S;
	private $ei03301T;
	private $ei03302S;
	private $ei03302T;
	private $ei03303S;
	private $ei03303T;
	private $ei03304S;
	private $ei03304T;
	private $ei03305S;
	private $ei03305T;
	private $ei03306S;
	private $ei03306T;
	private $ei03307S;
	private $ei03307T;
	private $ei03308S;
	private $ei03308T;
	private $ei0401S;
	private $ei0401T;
	private $ei0402S;
	private $ei0402T;
	private $ei0403S;
	private $ei0403T;
	private $ei0404S;
	private $ei0404T;
	private $ei0405S;
	private $ei0405T;
	private $ei0406S;
	private $ei0406T;
	private $ei0407S;
	private $ei0407T;
	private $ei0408S;
	private $ei0408T;
	private $ei0409S;
	private $ei0409T;
	private $ei0410S;
	private $ei0410T;
	private $ei0411S;
	private $ei0411T;
	private $ei0412S;
	private $ei0412T;
	private $ei0413S;
	private $ei0413T;
	private $ei0414S;
	private $ei0414T;
	private $ei0501S;
	private $ei0501T;
	private $ei0502S;
	private $ei0502T;
	private $ei0503S;
	private $ei0503T;
	private $ei0504S;
	private $ei0504T;
	private $ei0505S;
	private $ei0505T;
	private $ei0506S;
	private $ei0506T;
	private $ei0507S;
	private $ei0507T;
	private $ei0508S;
	private $ei0508T;
	private $ei0509S;
	private $ei0509T;
	private $ei0510S;
	private $ei0510T;
	private $ei0511S;
	private $ei0511T;
	private $ei0512S;
	private $ei0512T;
	private $ei0513S;
	private $ei0513T;
	private $ei0514S;
	private $ei0514T;
	private $ei0601S;
	private $ei0601T;
	private $ei0602S;
	private $ei0602T;
	private $ei0603S;
	private $ei0603T;
	private $ei0604S;
	private $ei0604T;
	private $ei0605S;
	private $ei0605T;
	private $ei0606S;
	private $ei0606T;
	private $ei0607S;
	private $ei0607T;
	private $ei0608S;
	private $ei0608T;
	private $ei0609S;
	private $ei0609T;
	private $ei0610S;
	private $ei0610T;
	private $ei0611S;
	private $ei0611T;
	private $ei0701S;
	private $ei0701T;
	private $ei0702S;
	private $ei0702T;
	private $ei0703S;
	private $ei0703T;
	private $ei0704S;
	private $ei0704T;
	private $ei0705S;
	private $ei0705T;
	private $ei0706S;
	private $ei0706T;
	private $ei0707S;
	private $ei0707T;
	private $ei0708S;
	private $ei0708T;
	private $ei08101S;
	private $ei08101T;
	private $ei08102S;
	private $ei08102T;
	private $ei08103S;
	private $ei08103T;
	private $ei08104S;
	private $ei08104T;
	private $ei08105S;
	private $ei08105T;
	private $ei08106S;
	private $ei08106T;
	private $ei08107S;
	private $ei08107T;
	private $ei08108S;
	private $ei08108T;
	private $ei08109S;
	private $ei08109T;
	private $ei08110S;
	private $ei08110T;
	private $ei08111S;
	private $ei08111T;
	private $ei08112S;
	private $ei08112T;
	private $ei08113S;
	private $ei08113T;
	private $ei08114S;
	private $ei08114T;
	private $ei08115S;
	private $ei08115T;
	private $ei08116S;
	private $ei08116T;
	private $ei08117S;
	private $ei08117T;
	private $ei08118S;
	private $ei08118T;
	private $ei08119S;
	private $ei08119T;
	private $ei08201S;
	private $ei08201T;
	private $ei08202S;
	private $ei08202T;
	private $ei08203S;
	private $ei08203T;
	private $ei08204S;
	private $ei08204T;
	private $ei08205S;
	private $ei08205T;
	private $ei08206S;
	private $ei08206T;
	private $ei08207S;
	private $ei08207T;
	private $ei08208S;
	private $ei08208T;
	private $ei08209S;
	private $ei08209T;
	private $ei08210S;
	private $ei08210T;
	private $ei08211S;
	private $ei08211T;
	private $ei08212S;
	private $ei08212T;
	private $ei08213S;
	private $ei08213T;
	private $ei08214S;
	private $ei08214T;
	private $ei08215S;
	private $ei08215T;
	private $ei08216S;
	private $ei08216T;
	private $ei08217S;
	private $ei08217T;
	private $ei08218S;
	private $ei08218T;
	private $ei08219S;
	private $ei08219T;
	private $ei08220S;
	private $ei08220T;
	private $ei08221S;
	private $ei08221T;
	private $ei08222S;
	private $ei08222T;
	private $ei08223S;
	private $ei08223T;
	private $ei08224S;
	private $ei08224T;
	private $ei08225S;
	private $ei08225T;
	private $ei08226S;
	private $ei08226T;
	private $ei08227S;
	private $ei08227T;
	private $ei0901T;

	/**
	 * set value for ei_id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $eiId
	 * @return Evalinstr
	 */
	public function &setEiId($eiId) {
		$this->notifyChanged(self::FIELD_EI_ID,$this->eiId,$eiId);
		$this->eiId=$eiId;
		return $this;
	}

	/**
	 * get value for ei_id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getEiId() {
		return $this->eiId;
	}

	/**
	 * set value for ei_datum 
	 *
	 * type:VARCHAR,size:30,default:0
	 *
	 * @param mixed $eiDatum
	 * @return Evalinstr
	 */
	public function &setEiDatum($eiDatum) {
		$this->notifyChanged(self::FIELD_EI_DATUM,$this->eiDatum,$eiDatum);
		$this->eiDatum=$eiDatum;
		return $this;
	}

	/**
	 * get value for ei_datum 
	 *
	 * type:VARCHAR,size:30,default:0
	 *
	 * @return mixed
	 */
	public function getEiDatum() {
		return $this->eiDatum;
	}

	/**
	 * set value for ei_01_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0101S
	 * @return Evalinstr
	 */
	public function &setEi0101S($ei0101S) {
		$this->notifyChanged(self::FIELD_EI_01_01_S,$this->ei0101S,$ei0101S);
		$this->ei0101S=$ei0101S;
		return $this;
	}

	/**
	 * get value for ei_01_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0101S() {
		return $this->ei0101S;
	}

	/**
	 * set value for ei_01_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0101T
	 * @return Evalinstr
	 */
	public function &setEi0101T($ei0101T) {
		$this->notifyChanged(self::FIELD_EI_01_01_T,$this->ei0101T,$ei0101T);
		$this->ei0101T=$ei0101T;
		return $this;
	}

	/**
	 * get value for ei_01_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0101T() {
		return $this->ei0101T;
	}

	/**
	 * set value for ei_01_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0102S
	 * @return Evalinstr
	 */
	public function &setEi0102S($ei0102S) {
		$this->notifyChanged(self::FIELD_EI_01_02_S,$this->ei0102S,$ei0102S);
		$this->ei0102S=$ei0102S;
		return $this;
	}

	/**
	 * get value for ei_01_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0102S() {
		return $this->ei0102S;
	}

	/**
	 * set value for ei_01_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0102T
	 * @return Evalinstr
	 */
	public function &setEi0102T($ei0102T) {
		$this->notifyChanged(self::FIELD_EI_01_02_T,$this->ei0102T,$ei0102T);
		$this->ei0102T=$ei0102T;
		return $this;
	}

	/**
	 * get value for ei_01_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0102T() {
		return $this->ei0102T;
	}

	/**
	 * set value for ei_01_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0103S
	 * @return Evalinstr
	 */
	public function &setEi0103S($ei0103S) {
		$this->notifyChanged(self::FIELD_EI_01_03_S,$this->ei0103S,$ei0103S);
		$this->ei0103S=$ei0103S;
		return $this;
	}

	/**
	 * get value for ei_01_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0103S() {
		return $this->ei0103S;
	}

	/**
	 * set value for ei_01_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0103T
	 * @return Evalinstr
	 */
	public function &setEi0103T($ei0103T) {
		$this->notifyChanged(self::FIELD_EI_01_03_T,$this->ei0103T,$ei0103T);
		$this->ei0103T=$ei0103T;
		return $this;
	}

	/**
	 * get value for ei_01_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0103T() {
		return $this->ei0103T;
	}

	/**
	 * set value for ei_01_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0104S
	 * @return Evalinstr
	 */
	public function &setEi0104S($ei0104S) {
		$this->notifyChanged(self::FIELD_EI_01_04_S,$this->ei0104S,$ei0104S);
		$this->ei0104S=$ei0104S;
		return $this;
	}

	/**
	 * get value for ei_01_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0104S() {
		return $this->ei0104S;
	}

	/**
	 * set value for ei_01_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0104T
	 * @return Evalinstr
	 */
	public function &setEi0104T($ei0104T) {
		$this->notifyChanged(self::FIELD_EI_01_04_T,$this->ei0104T,$ei0104T);
		$this->ei0104T=$ei0104T;
		return $this;
	}

	/**
	 * get value for ei_01_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0104T() {
		return $this->ei0104T;
	}

	/**
	 * set value for ei_01_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0105S
	 * @return Evalinstr
	 */
	public function &setEi0105S($ei0105S) {
		$this->notifyChanged(self::FIELD_EI_01_05_S,$this->ei0105S,$ei0105S);
		$this->ei0105S=$ei0105S;
		return $this;
	}

	/**
	 * get value for ei_01_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0105S() {
		return $this->ei0105S;
	}

	/**
	 * set value for ei_01_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0105T
	 * @return Evalinstr
	 */
	public function &setEi0105T($ei0105T) {
		$this->notifyChanged(self::FIELD_EI_01_05_T,$this->ei0105T,$ei0105T);
		$this->ei0105T=$ei0105T;
		return $this;
	}

	/**
	 * get value for ei_01_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0105T() {
		return $this->ei0105T;
	}

	/**
	 * set value for ei_01_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0106S
	 * @return Evalinstr
	 */
	public function &setEi0106S($ei0106S) {
		$this->notifyChanged(self::FIELD_EI_01_06_S,$this->ei0106S,$ei0106S);
		$this->ei0106S=$ei0106S;
		return $this;
	}

	/**
	 * get value for ei_01_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0106S() {
		return $this->ei0106S;
	}

	/**
	 * set value for ei_01_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0106T
	 * @return Evalinstr
	 */
	public function &setEi0106T($ei0106T) {
		$this->notifyChanged(self::FIELD_EI_01_06_T,$this->ei0106T,$ei0106T);
		$this->ei0106T=$ei0106T;
		return $this;
	}

	/**
	 * get value for ei_01_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0106T() {
		return $this->ei0106T;
	}

	/**
	 * set value for ei_01_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0107S
	 * @return Evalinstr
	 */
	public function &setEi0107S($ei0107S) {
		$this->notifyChanged(self::FIELD_EI_01_07_S,$this->ei0107S,$ei0107S);
		$this->ei0107S=$ei0107S;
		return $this;
	}

	/**
	 * get value for ei_01_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0107S() {
		return $this->ei0107S;
	}

	/**
	 * set value for ei_01_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0107T
	 * @return Evalinstr
	 */
	public function &setEi0107T($ei0107T) {
		$this->notifyChanged(self::FIELD_EI_01_07_T,$this->ei0107T,$ei0107T);
		$this->ei0107T=$ei0107T;
		return $this;
	}

	/**
	 * get value for ei_01_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0107T() {
		return $this->ei0107T;
	}

	/**
	 * set value for ei_02_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0201S
	 * @return Evalinstr
	 */
	public function &setEi0201S($ei0201S) {
		$this->notifyChanged(self::FIELD_EI_02_01_S,$this->ei0201S,$ei0201S);
		$this->ei0201S=$ei0201S;
		return $this;
	}

	/**
	 * get value for ei_02_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0201S() {
		return $this->ei0201S;
	}

	/**
	 * set value for ei_02_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0201T
	 * @return Evalinstr
	 */
	public function &setEi0201T($ei0201T) {
		$this->notifyChanged(self::FIELD_EI_02_01_T,$this->ei0201T,$ei0201T);
		$this->ei0201T=$ei0201T;
		return $this;
	}

	/**
	 * get value for ei_02_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0201T() {
		return $this->ei0201T;
	}

	/**
	 * set value for ei_02_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0202S
	 * @return Evalinstr
	 */
	public function &setEi0202S($ei0202S) {
		$this->notifyChanged(self::FIELD_EI_02_02_S,$this->ei0202S,$ei0202S);
		$this->ei0202S=$ei0202S;
		return $this;
	}

	/**
	 * get value for ei_02_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0202S() {
		return $this->ei0202S;
	}

	/**
	 * set value for ei_02_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0202T
	 * @return Evalinstr
	 */
	public function &setEi0202T($ei0202T) {
		$this->notifyChanged(self::FIELD_EI_02_02_T,$this->ei0202T,$ei0202T);
		$this->ei0202T=$ei0202T;
		return $this;
	}

	/**
	 * get value for ei_02_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0202T() {
		return $this->ei0202T;
	}

	/**
	 * set value for ei_02_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0203S
	 * @return Evalinstr
	 */
	public function &setEi0203S($ei0203S) {
		$this->notifyChanged(self::FIELD_EI_02_03_S,$this->ei0203S,$ei0203S);
		$this->ei0203S=$ei0203S;
		return $this;
	}

	/**
	 * get value for ei_02_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0203S() {
		return $this->ei0203S;
	}

	/**
	 * set value for ei_02_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0203T
	 * @return Evalinstr
	 */
	public function &setEi0203T($ei0203T) {
		$this->notifyChanged(self::FIELD_EI_02_03_T,$this->ei0203T,$ei0203T);
		$this->ei0203T=$ei0203T;
		return $this;
	}

	/**
	 * get value for ei_02_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0203T() {
		return $this->ei0203T;
	}

	/**
	 * set value for ei_02_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0204S
	 * @return Evalinstr
	 */
	public function &setEi0204S($ei0204S) {
		$this->notifyChanged(self::FIELD_EI_02_04_S,$this->ei0204S,$ei0204S);
		$this->ei0204S=$ei0204S;
		return $this;
	}

	/**
	 * get value for ei_02_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0204S() {
		return $this->ei0204S;
	}

	/**
	 * set value for ei_02_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0204T
	 * @return Evalinstr
	 */
	public function &setEi0204T($ei0204T) {
		$this->notifyChanged(self::FIELD_EI_02_04_T,$this->ei0204T,$ei0204T);
		$this->ei0204T=$ei0204T;
		return $this;
	}

	/**
	 * get value for ei_02_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0204T() {
		return $this->ei0204T;
	}

	/**
	 * set value for ei_02_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0205S
	 * @return Evalinstr
	 */
	public function &setEi0205S($ei0205S) {
		$this->notifyChanged(self::FIELD_EI_02_05_S,$this->ei0205S,$ei0205S);
		$this->ei0205S=$ei0205S;
		return $this;
	}

	/**
	 * get value for ei_02_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0205S() {
		return $this->ei0205S;
	}

	/**
	 * set value for ei_02_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0205T
	 * @return Evalinstr
	 */
	public function &setEi0205T($ei0205T) {
		$this->notifyChanged(self::FIELD_EI_02_05_T,$this->ei0205T,$ei0205T);
		$this->ei0205T=$ei0205T;
		return $this;
	}

	/**
	 * get value for ei_02_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0205T() {
		return $this->ei0205T;
	}

	/**
	 * set value for ei_02_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0206S
	 * @return Evalinstr
	 */
	public function &setEi0206S($ei0206S) {
		$this->notifyChanged(self::FIELD_EI_02_06_S,$this->ei0206S,$ei0206S);
		$this->ei0206S=$ei0206S;
		return $this;
	}

	/**
	 * get value for ei_02_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0206S() {
		return $this->ei0206S;
	}

	/**
	 * set value for ei_02_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0206T
	 * @return Evalinstr
	 */
	public function &setEi0206T($ei0206T) {
		$this->notifyChanged(self::FIELD_EI_02_06_T,$this->ei0206T,$ei0206T);
		$this->ei0206T=$ei0206T;
		return $this;
	}

	/**
	 * get value for ei_02_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0206T() {
		return $this->ei0206T;
	}

	/**
	 * set value for ei_02_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0207S
	 * @return Evalinstr
	 */
	public function &setEi0207S($ei0207S) {
		$this->notifyChanged(self::FIELD_EI_02_07_S,$this->ei0207S,$ei0207S);
		$this->ei0207S=$ei0207S;
		return $this;
	}

	/**
	 * get value for ei_02_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0207S() {
		return $this->ei0207S;
	}

	/**
	 * set value for ei_02_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0207T
	 * @return Evalinstr
	 */
	public function &setEi0207T($ei0207T) {
		$this->notifyChanged(self::FIELD_EI_02_07_T,$this->ei0207T,$ei0207T);
		$this->ei0207T=$ei0207T;
		return $this;
	}

	/**
	 * get value for ei_02_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0207T() {
		return $this->ei0207T;
	}

	/**
	 * set value for ei_02_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0208S
	 * @return Evalinstr
	 */
	public function &setEi0208S($ei0208S) {
		$this->notifyChanged(self::FIELD_EI_02_08_S,$this->ei0208S,$ei0208S);
		$this->ei0208S=$ei0208S;
		return $this;
	}

	/**
	 * get value for ei_02_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0208S() {
		return $this->ei0208S;
	}

	/**
	 * set value for ei_02_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0208T
	 * @return Evalinstr
	 */
	public function &setEi0208T($ei0208T) {
		$this->notifyChanged(self::FIELD_EI_02_08_T,$this->ei0208T,$ei0208T);
		$this->ei0208T=$ei0208T;
		return $this;
	}

	/**
	 * get value for ei_02_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0208T() {
		return $this->ei0208T;
	}

	/**
	 * set value for ei_02_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0209S
	 * @return Evalinstr
	 */
	public function &setEi0209S($ei0209S) {
		$this->notifyChanged(self::FIELD_EI_02_09_S,$this->ei0209S,$ei0209S);
		$this->ei0209S=$ei0209S;
		return $this;
	}

	/**
	 * get value for ei_02_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0209S() {
		return $this->ei0209S;
	}

	/**
	 * set value for ei_02_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0209T
	 * @return Evalinstr
	 */
	public function &setEi0209T($ei0209T) {
		$this->notifyChanged(self::FIELD_EI_02_09_T,$this->ei0209T,$ei0209T);
		$this->ei0209T=$ei0209T;
		return $this;
	}

	/**
	 * get value for ei_02_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0209T() {
		return $this->ei0209T;
	}

	/**
	 * set value for ei_031_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03101S
	 * @return Evalinstr
	 */
	public function &setEi03101S($ei03101S) {
		$this->notifyChanged(self::FIELD_EI_031_01_S,$this->ei03101S,$ei03101S);
		$this->ei03101S=$ei03101S;
		return $this;
	}

	/**
	 * get value for ei_031_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03101S() {
		return $this->ei03101S;
	}

	/**
	 * set value for ei_031_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03101T
	 * @return Evalinstr
	 */
	public function &setEi03101T($ei03101T) {
		$this->notifyChanged(self::FIELD_EI_031_01_T,$this->ei03101T,$ei03101T);
		$this->ei03101T=$ei03101T;
		return $this;
	}

	/**
	 * get value for ei_031_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03101T() {
		return $this->ei03101T;
	}

	/**
	 * set value for ei_031_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03102S
	 * @return Evalinstr
	 */
	public function &setEi03102S($ei03102S) {
		$this->notifyChanged(self::FIELD_EI_031_02_S,$this->ei03102S,$ei03102S);
		$this->ei03102S=$ei03102S;
		return $this;
	}

	/**
	 * get value for ei_031_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03102S() {
		return $this->ei03102S;
	}

	/**
	 * set value for ei_031_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03102T
	 * @return Evalinstr
	 */
	public function &setEi03102T($ei03102T) {
		$this->notifyChanged(self::FIELD_EI_031_02_T,$this->ei03102T,$ei03102T);
		$this->ei03102T=$ei03102T;
		return $this;
	}

	/**
	 * get value for ei_031_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03102T() {
		return $this->ei03102T;
	}

	/**
	 * set value for ei_031_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03103S
	 * @return Evalinstr
	 */
	public function &setEi03103S($ei03103S) {
		$this->notifyChanged(self::FIELD_EI_031_03_S,$this->ei03103S,$ei03103S);
		$this->ei03103S=$ei03103S;
		return $this;
	}

	/**
	 * get value for ei_031_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03103S() {
		return $this->ei03103S;
	}

	/**
	 * set value for ei_031_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03103T
	 * @return Evalinstr
	 */
	public function &setEi03103T($ei03103T) {
		$this->notifyChanged(self::FIELD_EI_031_03_T,$this->ei03103T,$ei03103T);
		$this->ei03103T=$ei03103T;
		return $this;
	}

	/**
	 * get value for ei_031_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03103T() {
		return $this->ei03103T;
	}

	/**
	 * set value for ei_031_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03104S
	 * @return Evalinstr
	 */
	public function &setEi03104S($ei03104S) {
		$this->notifyChanged(self::FIELD_EI_031_04_S,$this->ei03104S,$ei03104S);
		$this->ei03104S=$ei03104S;
		return $this;
	}

	/**
	 * get value for ei_031_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03104S() {
		return $this->ei03104S;
	}

	/**
	 * set value for ei_031_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03104T
	 * @return Evalinstr
	 */
	public function &setEi03104T($ei03104T) {
		$this->notifyChanged(self::FIELD_EI_031_04_T,$this->ei03104T,$ei03104T);
		$this->ei03104T=$ei03104T;
		return $this;
	}

	/**
	 * get value for ei_031_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03104T() {
		return $this->ei03104T;
	}

	/**
	 * set value for ei_031_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03105S
	 * @return Evalinstr
	 */
	public function &setEi03105S($ei03105S) {
		$this->notifyChanged(self::FIELD_EI_031_05_S,$this->ei03105S,$ei03105S);
		$this->ei03105S=$ei03105S;
		return $this;
	}

	/**
	 * get value for ei_031_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03105S() {
		return $this->ei03105S;
	}

	/**
	 * set value for ei_031_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03105T
	 * @return Evalinstr
	 */
	public function &setEi03105T($ei03105T) {
		$this->notifyChanged(self::FIELD_EI_031_05_T,$this->ei03105T,$ei03105T);
		$this->ei03105T=$ei03105T;
		return $this;
	}

	/**
	 * get value for ei_031_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03105T() {
		return $this->ei03105T;
	}

	/**
	 * set value for ei_031_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03106S
	 * @return Evalinstr
	 */
	public function &setEi03106S($ei03106S) {
		$this->notifyChanged(self::FIELD_EI_031_06_S,$this->ei03106S,$ei03106S);
		$this->ei03106S=$ei03106S;
		return $this;
	}

	/**
	 * get value for ei_031_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03106S() {
		return $this->ei03106S;
	}

	/**
	 * set value for ei_031_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03106T
	 * @return Evalinstr
	 */
	public function &setEi03106T($ei03106T) {
		$this->notifyChanged(self::FIELD_EI_031_06_T,$this->ei03106T,$ei03106T);
		$this->ei03106T=$ei03106T;
		return $this;
	}

	/**
	 * get value for ei_031_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03106T() {
		return $this->ei03106T;
	}

	/**
	 * set value for ei_031_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03107S
	 * @return Evalinstr
	 */
	public function &setEi03107S($ei03107S) {
		$this->notifyChanged(self::FIELD_EI_031_07_S,$this->ei03107S,$ei03107S);
		$this->ei03107S=$ei03107S;
		return $this;
	}

	/**
	 * get value for ei_031_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03107S() {
		return $this->ei03107S;
	}

	/**
	 * set value for ei_031_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03107T
	 * @return Evalinstr
	 */
	public function &setEi03107T($ei03107T) {
		$this->notifyChanged(self::FIELD_EI_031_07_T,$this->ei03107T,$ei03107T);
		$this->ei03107T=$ei03107T;
		return $this;
	}

	/**
	 * get value for ei_031_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03107T() {
		return $this->ei03107T;
	}

	/**
	 * set value for ei_031_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03108S
	 * @return Evalinstr
	 */
	public function &setEi03108S($ei03108S) {
		$this->notifyChanged(self::FIELD_EI_031_08_S,$this->ei03108S,$ei03108S);
		$this->ei03108S=$ei03108S;
		return $this;
	}

	/**
	 * get value for ei_031_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03108S() {
		return $this->ei03108S;
	}

	/**
	 * set value for ei_031_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03108T
	 * @return Evalinstr
	 */
	public function &setEi03108T($ei03108T) {
		$this->notifyChanged(self::FIELD_EI_031_08_T,$this->ei03108T,$ei03108T);
		$this->ei03108T=$ei03108T;
		return $this;
	}

	/**
	 * get value for ei_031_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03108T() {
		return $this->ei03108T;
	}

	/**
	 * set value for ei_032_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03201S
	 * @return Evalinstr
	 */
	public function &setEi03201S($ei03201S) {
		$this->notifyChanged(self::FIELD_EI_032_01_S,$this->ei03201S,$ei03201S);
		$this->ei03201S=$ei03201S;
		return $this;
	}

	/**
	 * get value for ei_032_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03201S() {
		return $this->ei03201S;
	}

	/**
	 * set value for ei_032_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03201T
	 * @return Evalinstr
	 */
	public function &setEi03201T($ei03201T) {
		$this->notifyChanged(self::FIELD_EI_032_01_T,$this->ei03201T,$ei03201T);
		$this->ei03201T=$ei03201T;
		return $this;
	}

	/**
	 * get value for ei_032_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03201T() {
		return $this->ei03201T;
	}

	/**
	 * set value for ei_032_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03202S
	 * @return Evalinstr
	 */
	public function &setEi03202S($ei03202S) {
		$this->notifyChanged(self::FIELD_EI_032_02_S,$this->ei03202S,$ei03202S);
		$this->ei03202S=$ei03202S;
		return $this;
	}

	/**
	 * get value for ei_032_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03202S() {
		return $this->ei03202S;
	}

	/**
	 * set value for ei_032_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03202T
	 * @return Evalinstr
	 */
	public function &setEi03202T($ei03202T) {
		$this->notifyChanged(self::FIELD_EI_032_02_T,$this->ei03202T,$ei03202T);
		$this->ei03202T=$ei03202T;
		return $this;
	}

	/**
	 * get value for ei_032_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03202T() {
		return $this->ei03202T;
	}

	/**
	 * set value for ei_032_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03203S
	 * @return Evalinstr
	 */
	public function &setEi03203S($ei03203S) {
		$this->notifyChanged(self::FIELD_EI_032_03_S,$this->ei03203S,$ei03203S);
		$this->ei03203S=$ei03203S;
		return $this;
	}

	/**
	 * get value for ei_032_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03203S() {
		return $this->ei03203S;
	}

	/**
	 * set value for ei_032_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03203T
	 * @return Evalinstr
	 */
	public function &setEi03203T($ei03203T) {
		$this->notifyChanged(self::FIELD_EI_032_03_T,$this->ei03203T,$ei03203T);
		$this->ei03203T=$ei03203T;
		return $this;
	}

	/**
	 * get value for ei_032_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03203T() {
		return $this->ei03203T;
	}

	/**
	 * set value for ei_032_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03204S
	 * @return Evalinstr
	 */
	public function &setEi03204S($ei03204S) {
		$this->notifyChanged(self::FIELD_EI_032_04_S,$this->ei03204S,$ei03204S);
		$this->ei03204S=$ei03204S;
		return $this;
	}

	/**
	 * get value for ei_032_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03204S() {
		return $this->ei03204S;
	}

	/**
	 * set value for ei_032_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03204T
	 * @return Evalinstr
	 */
	public function &setEi03204T($ei03204T) {
		$this->notifyChanged(self::FIELD_EI_032_04_T,$this->ei03204T,$ei03204T);
		$this->ei03204T=$ei03204T;
		return $this;
	}

	/**
	 * get value for ei_032_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03204T() {
		return $this->ei03204T;
	}

	/**
	 * set value for ei_032_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03205S
	 * @return Evalinstr
	 */
	public function &setEi03205S($ei03205S) {
		$this->notifyChanged(self::FIELD_EI_032_05_S,$this->ei03205S,$ei03205S);
		$this->ei03205S=$ei03205S;
		return $this;
	}

	/**
	 * get value for ei_032_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03205S() {
		return $this->ei03205S;
	}

	/**
	 * set value for ei_032_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03205T
	 * @return Evalinstr
	 */
	public function &setEi03205T($ei03205T) {
		$this->notifyChanged(self::FIELD_EI_032_05_T,$this->ei03205T,$ei03205T);
		$this->ei03205T=$ei03205T;
		return $this;
	}

	/**
	 * get value for ei_032_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03205T() {
		return $this->ei03205T;
	}

	/**
	 * set value for ei_032_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03206S
	 * @return Evalinstr
	 */
	public function &setEi03206S($ei03206S) {
		$this->notifyChanged(self::FIELD_EI_032_06_S,$this->ei03206S,$ei03206S);
		$this->ei03206S=$ei03206S;
		return $this;
	}

	/**
	 * get value for ei_032_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03206S() {
		return $this->ei03206S;
	}

	/**
	 * set value for ei_032_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03206T
	 * @return Evalinstr
	 */
	public function &setEi03206T($ei03206T) {
		$this->notifyChanged(self::FIELD_EI_032_06_T,$this->ei03206T,$ei03206T);
		$this->ei03206T=$ei03206T;
		return $this;
	}

	/**
	 * get value for ei_032_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03206T() {
		return $this->ei03206T;
	}

	/**
	 * set value for ei_032_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03207S
	 * @return Evalinstr
	 */
	public function &setEi03207S($ei03207S) {
		$this->notifyChanged(self::FIELD_EI_032_07_S,$this->ei03207S,$ei03207S);
		$this->ei03207S=$ei03207S;
		return $this;
	}

	/**
	 * get value for ei_032_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03207S() {
		return $this->ei03207S;
	}

	/**
	 * set value for ei_032_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03207T
	 * @return Evalinstr
	 */
	public function &setEi03207T($ei03207T) {
		$this->notifyChanged(self::FIELD_EI_032_07_T,$this->ei03207T,$ei03207T);
		$this->ei03207T=$ei03207T;
		return $this;
	}

	/**
	 * get value for ei_032_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03207T() {
		return $this->ei03207T;
	}

	/**
	 * set value for ei_032_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03208S
	 * @return Evalinstr
	 */
	public function &setEi03208S($ei03208S) {
		$this->notifyChanged(self::FIELD_EI_032_08_S,$this->ei03208S,$ei03208S);
		$this->ei03208S=$ei03208S;
		return $this;
	}

	/**
	 * get value for ei_032_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03208S() {
		return $this->ei03208S;
	}

	/**
	 * set value for ei_032_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03208T
	 * @return Evalinstr
	 */
	public function &setEi03208T($ei03208T) {
		$this->notifyChanged(self::FIELD_EI_032_08_T,$this->ei03208T,$ei03208T);
		$this->ei03208T=$ei03208T;
		return $this;
	}

	/**
	 * get value for ei_032_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03208T() {
		return $this->ei03208T;
	}

	/**
	 * set value for ei_032_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03209S
	 * @return Evalinstr
	 */
	public function &setEi03209S($ei03209S) {
		$this->notifyChanged(self::FIELD_EI_032_09_S,$this->ei03209S,$ei03209S);
		$this->ei03209S=$ei03209S;
		return $this;
	}

	/**
	 * get value for ei_032_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03209S() {
		return $this->ei03209S;
	}

	/**
	 * set value for ei_032_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03209T
	 * @return Evalinstr
	 */
	public function &setEi03209T($ei03209T) {
		$this->notifyChanged(self::FIELD_EI_032_09_T,$this->ei03209T,$ei03209T);
		$this->ei03209T=$ei03209T;
		return $this;
	}

	/**
	 * get value for ei_032_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03209T() {
		return $this->ei03209T;
	}

	/**
	 * set value for ei_032_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03210S
	 * @return Evalinstr
	 */
	public function &setEi03210S($ei03210S) {
		$this->notifyChanged(self::FIELD_EI_032_10_S,$this->ei03210S,$ei03210S);
		$this->ei03210S=$ei03210S;
		return $this;
	}

	/**
	 * get value for ei_032_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03210S() {
		return $this->ei03210S;
	}

	/**
	 * set value for ei_032_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03210T
	 * @return Evalinstr
	 */
	public function &setEi03210T($ei03210T) {
		$this->notifyChanged(self::FIELD_EI_032_10_T,$this->ei03210T,$ei03210T);
		$this->ei03210T=$ei03210T;
		return $this;
	}

	/**
	 * get value for ei_032_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03210T() {
		return $this->ei03210T;
	}

	/**
	 * set value for ei_032_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03211S
	 * @return Evalinstr
	 */
	public function &setEi03211S($ei03211S) {
		$this->notifyChanged(self::FIELD_EI_032_11_S,$this->ei03211S,$ei03211S);
		$this->ei03211S=$ei03211S;
		return $this;
	}

	/**
	 * get value for ei_032_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03211S() {
		return $this->ei03211S;
	}

	/**
	 * set value for ei_032_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03211T
	 * @return Evalinstr
	 */
	public function &setEi03211T($ei03211T) {
		$this->notifyChanged(self::FIELD_EI_032_11_T,$this->ei03211T,$ei03211T);
		$this->ei03211T=$ei03211T;
		return $this;
	}

	/**
	 * get value for ei_032_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03211T() {
		return $this->ei03211T;
	}

	/**
	 * set value for ei_032_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03212S
	 * @return Evalinstr
	 */
	public function &setEi03212S($ei03212S) {
		$this->notifyChanged(self::FIELD_EI_032_12_S,$this->ei03212S,$ei03212S);
		$this->ei03212S=$ei03212S;
		return $this;
	}

	/**
	 * get value for ei_032_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03212S() {
		return $this->ei03212S;
	}

	/**
	 * set value for ei_032_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03212T
	 * @return Evalinstr
	 */
	public function &setEi03212T($ei03212T) {
		$this->notifyChanged(self::FIELD_EI_032_12_T,$this->ei03212T,$ei03212T);
		$this->ei03212T=$ei03212T;
		return $this;
	}

	/**
	 * get value for ei_032_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03212T() {
		return $this->ei03212T;
	}

	/**
	 * set value for ei_032_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03213S
	 * @return Evalinstr
	 */
	public function &setEi03213S($ei03213S) {
		$this->notifyChanged(self::FIELD_EI_032_13_S,$this->ei03213S,$ei03213S);
		$this->ei03213S=$ei03213S;
		return $this;
	}

	/**
	 * get value for ei_032_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03213S() {
		return $this->ei03213S;
	}

	/**
	 * set value for ei_032_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03213T
	 * @return Evalinstr
	 */
	public function &setEi03213T($ei03213T) {
		$this->notifyChanged(self::FIELD_EI_032_13_T,$this->ei03213T,$ei03213T);
		$this->ei03213T=$ei03213T;
		return $this;
	}

	/**
	 * get value for ei_032_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03213T() {
		return $this->ei03213T;
	}

	/**
	 * set value for ei_032_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03214S
	 * @return Evalinstr
	 */
	public function &setEi03214S($ei03214S) {
		$this->notifyChanged(self::FIELD_EI_032_14_S,$this->ei03214S,$ei03214S);
		$this->ei03214S=$ei03214S;
		return $this;
	}

	/**
	 * get value for ei_032_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03214S() {
		return $this->ei03214S;
	}

	/**
	 * set value for ei_032_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03214T
	 * @return Evalinstr
	 */
	public function &setEi03214T($ei03214T) {
		$this->notifyChanged(self::FIELD_EI_032_14_T,$this->ei03214T,$ei03214T);
		$this->ei03214T=$ei03214T;
		return $this;
	}

	/**
	 * get value for ei_032_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03214T() {
		return $this->ei03214T;
	}

	/**
	 * set value for ei_033_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03301S
	 * @return Evalinstr
	 */
	public function &setEi03301S($ei03301S) {
		$this->notifyChanged(self::FIELD_EI_033_01_S,$this->ei03301S,$ei03301S);
		$this->ei03301S=$ei03301S;
		return $this;
	}

	/**
	 * get value for ei_033_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03301S() {
		return $this->ei03301S;
	}

	/**
	 * set value for ei_033_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03301T
	 * @return Evalinstr
	 */
	public function &setEi03301T($ei03301T) {
		$this->notifyChanged(self::FIELD_EI_033_01_T,$this->ei03301T,$ei03301T);
		$this->ei03301T=$ei03301T;
		return $this;
	}

	/**
	 * get value for ei_033_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03301T() {
		return $this->ei03301T;
	}

	/**
	 * set value for ei_033_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03302S
	 * @return Evalinstr
	 */
	public function &setEi03302S($ei03302S) {
		$this->notifyChanged(self::FIELD_EI_033_02_S,$this->ei03302S,$ei03302S);
		$this->ei03302S=$ei03302S;
		return $this;
	}

	/**
	 * get value for ei_033_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03302S() {
		return $this->ei03302S;
	}

	/**
	 * set value for ei_033_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03302T
	 * @return Evalinstr
	 */
	public function &setEi03302T($ei03302T) {
		$this->notifyChanged(self::FIELD_EI_033_02_T,$this->ei03302T,$ei03302T);
		$this->ei03302T=$ei03302T;
		return $this;
	}

	/**
	 * get value for ei_033_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03302T() {
		return $this->ei03302T;
	}

	/**
	 * set value for ei_033_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03303S
	 * @return Evalinstr
	 */
	public function &setEi03303S($ei03303S) {
		$this->notifyChanged(self::FIELD_EI_033_03_S,$this->ei03303S,$ei03303S);
		$this->ei03303S=$ei03303S;
		return $this;
	}

	/**
	 * get value for ei_033_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03303S() {
		return $this->ei03303S;
	}

	/**
	 * set value for ei_033_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03303T
	 * @return Evalinstr
	 */
	public function &setEi03303T($ei03303T) {
		$this->notifyChanged(self::FIELD_EI_033_03_T,$this->ei03303T,$ei03303T);
		$this->ei03303T=$ei03303T;
		return $this;
	}

	/**
	 * get value for ei_033_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03303T() {
		return $this->ei03303T;
	}

	/**
	 * set value for ei_033_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03304S
	 * @return Evalinstr
	 */
	public function &setEi03304S($ei03304S) {
		$this->notifyChanged(self::FIELD_EI_033_04_S,$this->ei03304S,$ei03304S);
		$this->ei03304S=$ei03304S;
		return $this;
	}

	/**
	 * get value for ei_033_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03304S() {
		return $this->ei03304S;
	}

	/**
	 * set value for ei_033_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03304T
	 * @return Evalinstr
	 */
	public function &setEi03304T($ei03304T) {
		$this->notifyChanged(self::FIELD_EI_033_04_T,$this->ei03304T,$ei03304T);
		$this->ei03304T=$ei03304T;
		return $this;
	}

	/**
	 * get value for ei_033_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03304T() {
		return $this->ei03304T;
	}

	/**
	 * set value for ei_033_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03305S
	 * @return Evalinstr
	 */
	public function &setEi03305S($ei03305S) {
		$this->notifyChanged(self::FIELD_EI_033_05_S,$this->ei03305S,$ei03305S);
		$this->ei03305S=$ei03305S;
		return $this;
	}

	/**
	 * get value for ei_033_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03305S() {
		return $this->ei03305S;
	}

	/**
	 * set value for ei_033_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03305T
	 * @return Evalinstr
	 */
	public function &setEi03305T($ei03305T) {
		$this->notifyChanged(self::FIELD_EI_033_05_T,$this->ei03305T,$ei03305T);
		$this->ei03305T=$ei03305T;
		return $this;
	}

	/**
	 * get value for ei_033_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03305T() {
		return $this->ei03305T;
	}

	/**
	 * set value for ei_033_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03306S
	 * @return Evalinstr
	 */
	public function &setEi03306S($ei03306S) {
		$this->notifyChanged(self::FIELD_EI_033_06_S,$this->ei03306S,$ei03306S);
		$this->ei03306S=$ei03306S;
		return $this;
	}

	/**
	 * get value for ei_033_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03306S() {
		return $this->ei03306S;
	}

	/**
	 * set value for ei_033_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03306T
	 * @return Evalinstr
	 */
	public function &setEi03306T($ei03306T) {
		$this->notifyChanged(self::FIELD_EI_033_06_T,$this->ei03306T,$ei03306T);
		$this->ei03306T=$ei03306T;
		return $this;
	}

	/**
	 * get value for ei_033_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03306T() {
		return $this->ei03306T;
	}

	/**
	 * set value for ei_033_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03307S
	 * @return Evalinstr
	 */
	public function &setEi03307S($ei03307S) {
		$this->notifyChanged(self::FIELD_EI_033_07_S,$this->ei03307S,$ei03307S);
		$this->ei03307S=$ei03307S;
		return $this;
	}

	/**
	 * get value for ei_033_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03307S() {
		return $this->ei03307S;
	}

	/**
	 * set value for ei_033_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03307T
	 * @return Evalinstr
	 */
	public function &setEi03307T($ei03307T) {
		$this->notifyChanged(self::FIELD_EI_033_07_T,$this->ei03307T,$ei03307T);
		$this->ei03307T=$ei03307T;
		return $this;
	}

	/**
	 * get value for ei_033_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03307T() {
		return $this->ei03307T;
	}

	/**
	 * set value for ei_033_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei03308S
	 * @return Evalinstr
	 */
	public function &setEi03308S($ei03308S) {
		$this->notifyChanged(self::FIELD_EI_033_08_S,$this->ei03308S,$ei03308S);
		$this->ei03308S=$ei03308S;
		return $this;
	}

	/**
	 * get value for ei_033_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi03308S() {
		return $this->ei03308S;
	}

	/**
	 * set value for ei_033_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei03308T
	 * @return Evalinstr
	 */
	public function &setEi03308T($ei03308T) {
		$this->notifyChanged(self::FIELD_EI_033_08_T,$this->ei03308T,$ei03308T);
		$this->ei03308T=$ei03308T;
		return $this;
	}

	/**
	 * get value for ei_033_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi03308T() {
		return $this->ei03308T;
	}

	/**
	 * set value for ei_04_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0401S
	 * @return Evalinstr
	 */
	public function &setEi0401S($ei0401S) {
		$this->notifyChanged(self::FIELD_EI_04_01_S,$this->ei0401S,$ei0401S);
		$this->ei0401S=$ei0401S;
		return $this;
	}

	/**
	 * get value for ei_04_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0401S() {
		return $this->ei0401S;
	}

	/**
	 * set value for ei_04_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0401T
	 * @return Evalinstr
	 */
	public function &setEi0401T($ei0401T) {
		$this->notifyChanged(self::FIELD_EI_04_01_T,$this->ei0401T,$ei0401T);
		$this->ei0401T=$ei0401T;
		return $this;
	}

	/**
	 * get value for ei_04_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0401T() {
		return $this->ei0401T;
	}

	/**
	 * set value for ei_04_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0402S
	 * @return Evalinstr
	 */
	public function &setEi0402S($ei0402S) {
		$this->notifyChanged(self::FIELD_EI_04_02_S,$this->ei0402S,$ei0402S);
		$this->ei0402S=$ei0402S;
		return $this;
	}

	/**
	 * get value for ei_04_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0402S() {
		return $this->ei0402S;
	}

	/**
	 * set value for ei_04_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0402T
	 * @return Evalinstr
	 */
	public function &setEi0402T($ei0402T) {
		$this->notifyChanged(self::FIELD_EI_04_02_T,$this->ei0402T,$ei0402T);
		$this->ei0402T=$ei0402T;
		return $this;
	}

	/**
	 * get value for ei_04_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0402T() {
		return $this->ei0402T;
	}

	/**
	 * set value for ei_04_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0403S
	 * @return Evalinstr
	 */
	public function &setEi0403S($ei0403S) {
		$this->notifyChanged(self::FIELD_EI_04_03_S,$this->ei0403S,$ei0403S);
		$this->ei0403S=$ei0403S;
		return $this;
	}

	/**
	 * get value for ei_04_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0403S() {
		return $this->ei0403S;
	}

	/**
	 * set value for ei_04_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0403T
	 * @return Evalinstr
	 */
	public function &setEi0403T($ei0403T) {
		$this->notifyChanged(self::FIELD_EI_04_03_T,$this->ei0403T,$ei0403T);
		$this->ei0403T=$ei0403T;
		return $this;
	}

	/**
	 * get value for ei_04_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0403T() {
		return $this->ei0403T;
	}

	/**
	 * set value for ei_04_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0404S
	 * @return Evalinstr
	 */
	public function &setEi0404S($ei0404S) {
		$this->notifyChanged(self::FIELD_EI_04_04_S,$this->ei0404S,$ei0404S);
		$this->ei0404S=$ei0404S;
		return $this;
	}

	/**
	 * get value for ei_04_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0404S() {
		return $this->ei0404S;
	}

	/**
	 * set value for ei_04_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0404T
	 * @return Evalinstr
	 */
	public function &setEi0404T($ei0404T) {
		$this->notifyChanged(self::FIELD_EI_04_04_T,$this->ei0404T,$ei0404T);
		$this->ei0404T=$ei0404T;
		return $this;
	}

	/**
	 * get value for ei_04_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0404T() {
		return $this->ei0404T;
	}

	/**
	 * set value for ei_04_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0405S
	 * @return Evalinstr
	 */
	public function &setEi0405S($ei0405S) {
		$this->notifyChanged(self::FIELD_EI_04_05_S,$this->ei0405S,$ei0405S);
		$this->ei0405S=$ei0405S;
		return $this;
	}

	/**
	 * get value for ei_04_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0405S() {
		return $this->ei0405S;
	}

	/**
	 * set value for ei_04_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0405T
	 * @return Evalinstr
	 */
	public function &setEi0405T($ei0405T) {
		$this->notifyChanged(self::FIELD_EI_04_05_T,$this->ei0405T,$ei0405T);
		$this->ei0405T=$ei0405T;
		return $this;
	}

	/**
	 * get value for ei_04_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0405T() {
		return $this->ei0405T;
	}

	/**
	 * set value for ei_04_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0406S
	 * @return Evalinstr
	 */
	public function &setEi0406S($ei0406S) {
		$this->notifyChanged(self::FIELD_EI_04_06_S,$this->ei0406S,$ei0406S);
		$this->ei0406S=$ei0406S;
		return $this;
	}

	/**
	 * get value for ei_04_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0406S() {
		return $this->ei0406S;
	}

	/**
	 * set value for ei_04_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0406T
	 * @return Evalinstr
	 */
	public function &setEi0406T($ei0406T) {
		$this->notifyChanged(self::FIELD_EI_04_06_T,$this->ei0406T,$ei0406T);
		$this->ei0406T=$ei0406T;
		return $this;
	}

	/**
	 * get value for ei_04_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0406T() {
		return $this->ei0406T;
	}

	/**
	 * set value for ei_04_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0407S
	 * @return Evalinstr
	 */
	public function &setEi0407S($ei0407S) {
		$this->notifyChanged(self::FIELD_EI_04_07_S,$this->ei0407S,$ei0407S);
		$this->ei0407S=$ei0407S;
		return $this;
	}

	/**
	 * get value for ei_04_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0407S() {
		return $this->ei0407S;
	}

	/**
	 * set value for ei_04_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0407T
	 * @return Evalinstr
	 */
	public function &setEi0407T($ei0407T) {
		$this->notifyChanged(self::FIELD_EI_04_07_T,$this->ei0407T,$ei0407T);
		$this->ei0407T=$ei0407T;
		return $this;
	}

	/**
	 * get value for ei_04_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0407T() {
		return $this->ei0407T;
	}

	/**
	 * set value for ei_04_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0408S
	 * @return Evalinstr
	 */
	public function &setEi0408S($ei0408S) {
		$this->notifyChanged(self::FIELD_EI_04_08_S,$this->ei0408S,$ei0408S);
		$this->ei0408S=$ei0408S;
		return $this;
	}

	/**
	 * get value for ei_04_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0408S() {
		return $this->ei0408S;
	}

	/**
	 * set value for ei_04_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0408T
	 * @return Evalinstr
	 */
	public function &setEi0408T($ei0408T) {
		$this->notifyChanged(self::FIELD_EI_04_08_T,$this->ei0408T,$ei0408T);
		$this->ei0408T=$ei0408T;
		return $this;
	}

	/**
	 * get value for ei_04_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0408T() {
		return $this->ei0408T;
	}

	/**
	 * set value for ei_04_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0409S
	 * @return Evalinstr
	 */
	public function &setEi0409S($ei0409S) {
		$this->notifyChanged(self::FIELD_EI_04_09_S,$this->ei0409S,$ei0409S);
		$this->ei0409S=$ei0409S;
		return $this;
	}

	/**
	 * get value for ei_04_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0409S() {
		return $this->ei0409S;
	}

	/**
	 * set value for ei_04_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0409T
	 * @return Evalinstr
	 */
	public function &setEi0409T($ei0409T) {
		$this->notifyChanged(self::FIELD_EI_04_09_T,$this->ei0409T,$ei0409T);
		$this->ei0409T=$ei0409T;
		return $this;
	}

	/**
	 * get value for ei_04_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0409T() {
		return $this->ei0409T;
	}

	/**
	 * set value for ei_04_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0410S
	 * @return Evalinstr
	 */
	public function &setEi0410S($ei0410S) {
		$this->notifyChanged(self::FIELD_EI_04_10_S,$this->ei0410S,$ei0410S);
		$this->ei0410S=$ei0410S;
		return $this;
	}

	/**
	 * get value for ei_04_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0410S() {
		return $this->ei0410S;
	}

	/**
	 * set value for ei_04_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0410T
	 * @return Evalinstr
	 */
	public function &setEi0410T($ei0410T) {
		$this->notifyChanged(self::FIELD_EI_04_10_T,$this->ei0410T,$ei0410T);
		$this->ei0410T=$ei0410T;
		return $this;
	}

	/**
	 * get value for ei_04_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0410T() {
		return $this->ei0410T;
	}

	/**
	 * set value for ei_04_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0411S
	 * @return Evalinstr
	 */
	public function &setEi0411S($ei0411S) {
		$this->notifyChanged(self::FIELD_EI_04_11_S,$this->ei0411S,$ei0411S);
		$this->ei0411S=$ei0411S;
		return $this;
	}

	/**
	 * get value for ei_04_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0411S() {
		return $this->ei0411S;
	}

	/**
	 * set value for ei_04_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0411T
	 * @return Evalinstr
	 */
	public function &setEi0411T($ei0411T) {
		$this->notifyChanged(self::FIELD_EI_04_11_T,$this->ei0411T,$ei0411T);
		$this->ei0411T=$ei0411T;
		return $this;
	}

	/**
	 * get value for ei_04_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0411T() {
		return $this->ei0411T;
	}

	/**
	 * set value for ei_04_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0412S
	 * @return Evalinstr
	 */
	public function &setEi0412S($ei0412S) {
		$this->notifyChanged(self::FIELD_EI_04_12_S,$this->ei0412S,$ei0412S);
		$this->ei0412S=$ei0412S;
		return $this;
	}

	/**
	 * get value for ei_04_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0412S() {
		return $this->ei0412S;
	}

	/**
	 * set value for ei_04_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0412T
	 * @return Evalinstr
	 */
	public function &setEi0412T($ei0412T) {
		$this->notifyChanged(self::FIELD_EI_04_12_T,$this->ei0412T,$ei0412T);
		$this->ei0412T=$ei0412T;
		return $this;
	}

	/**
	 * get value for ei_04_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0412T() {
		return $this->ei0412T;
	}

	/**
	 * set value for ei_04_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0413S
	 * @return Evalinstr
	 */
	public function &setEi0413S($ei0413S) {
		$this->notifyChanged(self::FIELD_EI_04_13_S,$this->ei0413S,$ei0413S);
		$this->ei0413S=$ei0413S;
		return $this;
	}

	/**
	 * get value for ei_04_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0413S() {
		return $this->ei0413S;
	}

	/**
	 * set value for ei_04_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0413T
	 * @return Evalinstr
	 */
	public function &setEi0413T($ei0413T) {
		$this->notifyChanged(self::FIELD_EI_04_13_T,$this->ei0413T,$ei0413T);
		$this->ei0413T=$ei0413T;
		return $this;
	}

	/**
	 * get value for ei_04_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0413T() {
		return $this->ei0413T;
	}

	/**
	 * set value for ei_04_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0414S
	 * @return Evalinstr
	 */
	public function &setEi0414S($ei0414S) {
		$this->notifyChanged(self::FIELD_EI_04_14_S,$this->ei0414S,$ei0414S);
		$this->ei0414S=$ei0414S;
		return $this;
	}

	/**
	 * get value for ei_04_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0414S() {
		return $this->ei0414S;
	}

	/**
	 * set value for ei_04_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0414T
	 * @return Evalinstr
	 */
	public function &setEi0414T($ei0414T) {
		$this->notifyChanged(self::FIELD_EI_04_14_T,$this->ei0414T,$ei0414T);
		$this->ei0414T=$ei0414T;
		return $this;
	}

	/**
	 * get value for ei_04_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0414T() {
		return $this->ei0414T;
	}

	/**
	 * set value for ei_05_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0501S
	 * @return Evalinstr
	 */
	public function &setEi0501S($ei0501S) {
		$this->notifyChanged(self::FIELD_EI_05_01_S,$this->ei0501S,$ei0501S);
		$this->ei0501S=$ei0501S;
		return $this;
	}

	/**
	 * get value for ei_05_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0501S() {
		return $this->ei0501S;
	}

	/**
	 * set value for ei_05_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0501T
	 * @return Evalinstr
	 */
	public function &setEi0501T($ei0501T) {
		$this->notifyChanged(self::FIELD_EI_05_01_T,$this->ei0501T,$ei0501T);
		$this->ei0501T=$ei0501T;
		return $this;
	}

	/**
	 * get value for ei_05_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0501T() {
		return $this->ei0501T;
	}

	/**
	 * set value for ei_05_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0502S
	 * @return Evalinstr
	 */
	public function &setEi0502S($ei0502S) {
		$this->notifyChanged(self::FIELD_EI_05_02_S,$this->ei0502S,$ei0502S);
		$this->ei0502S=$ei0502S;
		return $this;
	}

	/**
	 * get value for ei_05_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0502S() {
		return $this->ei0502S;
	}

	/**
	 * set value for ei_05_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0502T
	 * @return Evalinstr
	 */
	public function &setEi0502T($ei0502T) {
		$this->notifyChanged(self::FIELD_EI_05_02_T,$this->ei0502T,$ei0502T);
		$this->ei0502T=$ei0502T;
		return $this;
	}

	/**
	 * get value for ei_05_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0502T() {
		return $this->ei0502T;
	}

	/**
	 * set value for ei_05_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0503S
	 * @return Evalinstr
	 */
	public function &setEi0503S($ei0503S) {
		$this->notifyChanged(self::FIELD_EI_05_03_S,$this->ei0503S,$ei0503S);
		$this->ei0503S=$ei0503S;
		return $this;
	}

	/**
	 * get value for ei_05_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0503S() {
		return $this->ei0503S;
	}

	/**
	 * set value for ei_05_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0503T
	 * @return Evalinstr
	 */
	public function &setEi0503T($ei0503T) {
		$this->notifyChanged(self::FIELD_EI_05_03_T,$this->ei0503T,$ei0503T);
		$this->ei0503T=$ei0503T;
		return $this;
	}

	/**
	 * get value for ei_05_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0503T() {
		return $this->ei0503T;
	}

	/**
	 * set value for ei_05_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0504S
	 * @return Evalinstr
	 */
	public function &setEi0504S($ei0504S) {
		$this->notifyChanged(self::FIELD_EI_05_04_S,$this->ei0504S,$ei0504S);
		$this->ei0504S=$ei0504S;
		return $this;
	}

	/**
	 * get value for ei_05_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0504S() {
		return $this->ei0504S;
	}

	/**
	 * set value for ei_05_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0504T
	 * @return Evalinstr
	 */
	public function &setEi0504T($ei0504T) {
		$this->notifyChanged(self::FIELD_EI_05_04_T,$this->ei0504T,$ei0504T);
		$this->ei0504T=$ei0504T;
		return $this;
	}

	/**
	 * get value for ei_05_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0504T() {
		return $this->ei0504T;
	}

	/**
	 * set value for ei_05_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0505S
	 * @return Evalinstr
	 */
	public function &setEi0505S($ei0505S) {
		$this->notifyChanged(self::FIELD_EI_05_05_S,$this->ei0505S,$ei0505S);
		$this->ei0505S=$ei0505S;
		return $this;
	}

	/**
	 * get value for ei_05_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0505S() {
		return $this->ei0505S;
	}

	/**
	 * set value for ei_05_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0505T
	 * @return Evalinstr
	 */
	public function &setEi0505T($ei0505T) {
		$this->notifyChanged(self::FIELD_EI_05_05_T,$this->ei0505T,$ei0505T);
		$this->ei0505T=$ei0505T;
		return $this;
	}

	/**
	 * get value for ei_05_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0505T() {
		return $this->ei0505T;
	}

	/**
	 * set value for ei_05_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0506S
	 * @return Evalinstr
	 */
	public function &setEi0506S($ei0506S) {
		$this->notifyChanged(self::FIELD_EI_05_06_S,$this->ei0506S,$ei0506S);
		$this->ei0506S=$ei0506S;
		return $this;
	}

	/**
	 * get value for ei_05_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0506S() {
		return $this->ei0506S;
	}

	/**
	 * set value for ei_05_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0506T
	 * @return Evalinstr
	 */
	public function &setEi0506T($ei0506T) {
		$this->notifyChanged(self::FIELD_EI_05_06_T,$this->ei0506T,$ei0506T);
		$this->ei0506T=$ei0506T;
		return $this;
	}

	/**
	 * get value for ei_05_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0506T() {
		return $this->ei0506T;
	}

	/**
	 * set value for ei_05_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0507S
	 * @return Evalinstr
	 */
	public function &setEi0507S($ei0507S) {
		$this->notifyChanged(self::FIELD_EI_05_07_S,$this->ei0507S,$ei0507S);
		$this->ei0507S=$ei0507S;
		return $this;
	}

	/**
	 * get value for ei_05_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0507S() {
		return $this->ei0507S;
	}

	/**
	 * set value for ei_05_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0507T
	 * @return Evalinstr
	 */
	public function &setEi0507T($ei0507T) {
		$this->notifyChanged(self::FIELD_EI_05_07_T,$this->ei0507T,$ei0507T);
		$this->ei0507T=$ei0507T;
		return $this;
	}

	/**
	 * get value for ei_05_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0507T() {
		return $this->ei0507T;
	}

	/**
	 * set value for ei_05_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0508S
	 * @return Evalinstr
	 */
	public function &setEi0508S($ei0508S) {
		$this->notifyChanged(self::FIELD_EI_05_08_S,$this->ei0508S,$ei0508S);
		$this->ei0508S=$ei0508S;
		return $this;
	}

	/**
	 * get value for ei_05_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0508S() {
		return $this->ei0508S;
	}

	/**
	 * set value for ei_05_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0508T
	 * @return Evalinstr
	 */
	public function &setEi0508T($ei0508T) {
		$this->notifyChanged(self::FIELD_EI_05_08_T,$this->ei0508T,$ei0508T);
		$this->ei0508T=$ei0508T;
		return $this;
	}

	/**
	 * get value for ei_05_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0508T() {
		return $this->ei0508T;
	}

	/**
	 * set value for ei_05_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0509S
	 * @return Evalinstr
	 */
	public function &setEi0509S($ei0509S) {
		$this->notifyChanged(self::FIELD_EI_05_09_S,$this->ei0509S,$ei0509S);
		$this->ei0509S=$ei0509S;
		return $this;
	}

	/**
	 * get value for ei_05_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0509S() {
		return $this->ei0509S;
	}

	/**
	 * set value for ei_05_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0509T
	 * @return Evalinstr
	 */
	public function &setEi0509T($ei0509T) {
		$this->notifyChanged(self::FIELD_EI_05_09_T,$this->ei0509T,$ei0509T);
		$this->ei0509T=$ei0509T;
		return $this;
	}

	/**
	 * get value for ei_05_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0509T() {
		return $this->ei0509T;
	}

	/**
	 * set value for ei_05_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0510S
	 * @return Evalinstr
	 */
	public function &setEi0510S($ei0510S) {
		$this->notifyChanged(self::FIELD_EI_05_10_S,$this->ei0510S,$ei0510S);
		$this->ei0510S=$ei0510S;
		return $this;
	}

	/**
	 * get value for ei_05_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0510S() {
		return $this->ei0510S;
	}

	/**
	 * set value for ei_05_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0510T
	 * @return Evalinstr
	 */
	public function &setEi0510T($ei0510T) {
		$this->notifyChanged(self::FIELD_EI_05_10_T,$this->ei0510T,$ei0510T);
		$this->ei0510T=$ei0510T;
		return $this;
	}

	/**
	 * get value for ei_05_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0510T() {
		return $this->ei0510T;
	}

	/**
	 * set value for ei_05_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0511S
	 * @return Evalinstr
	 */
	public function &setEi0511S($ei0511S) {
		$this->notifyChanged(self::FIELD_EI_05_11_S,$this->ei0511S,$ei0511S);
		$this->ei0511S=$ei0511S;
		return $this;
	}

	/**
	 * get value for ei_05_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0511S() {
		return $this->ei0511S;
	}

	/**
	 * set value for ei_05_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0511T
	 * @return Evalinstr
	 */
	public function &setEi0511T($ei0511T) {
		$this->notifyChanged(self::FIELD_EI_05_11_T,$this->ei0511T,$ei0511T);
		$this->ei0511T=$ei0511T;
		return $this;
	}

	/**
	 * get value for ei_05_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0511T() {
		return $this->ei0511T;
	}

	/**
	 * set value for ei_05_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0512S
	 * @return Evalinstr
	 */
	public function &setEi0512S($ei0512S) {
		$this->notifyChanged(self::FIELD_EI_05_12_S,$this->ei0512S,$ei0512S);
		$this->ei0512S=$ei0512S;
		return $this;
	}

	/**
	 * get value for ei_05_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0512S() {
		return $this->ei0512S;
	}

	/**
	 * set value for ei_05_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0512T
	 * @return Evalinstr
	 */
	public function &setEi0512T($ei0512T) {
		$this->notifyChanged(self::FIELD_EI_05_12_T,$this->ei0512T,$ei0512T);
		$this->ei0512T=$ei0512T;
		return $this;
	}

	/**
	 * get value for ei_05_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0512T() {
		return $this->ei0512T;
	}

	/**
	 * set value for ei_05_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0513S
	 * @return Evalinstr
	 */
	public function &setEi0513S($ei0513S) {
		$this->notifyChanged(self::FIELD_EI_05_13_S,$this->ei0513S,$ei0513S);
		$this->ei0513S=$ei0513S;
		return $this;
	}

	/**
	 * get value for ei_05_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0513S() {
		return $this->ei0513S;
	}

	/**
	 * set value for ei_05_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0513T
	 * @return Evalinstr
	 */
	public function &setEi0513T($ei0513T) {
		$this->notifyChanged(self::FIELD_EI_05_13_T,$this->ei0513T,$ei0513T);
		$this->ei0513T=$ei0513T;
		return $this;
	}

	/**
	 * get value for ei_05_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0513T() {
		return $this->ei0513T;
	}

	/**
	 * set value for ei_05_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0514S
	 * @return Evalinstr
	 */
	public function &setEi0514S($ei0514S) {
		$this->notifyChanged(self::FIELD_EI_05_14_S,$this->ei0514S,$ei0514S);
		$this->ei0514S=$ei0514S;
		return $this;
	}

	/**
	 * get value for ei_05_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0514S() {
		return $this->ei0514S;
	}

	/**
	 * set value for ei_05_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0514T
	 * @return Evalinstr
	 */
	public function &setEi0514T($ei0514T) {
		$this->notifyChanged(self::FIELD_EI_05_14_T,$this->ei0514T,$ei0514T);
		$this->ei0514T=$ei0514T;
		return $this;
	}

	/**
	 * get value for ei_05_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0514T() {
		return $this->ei0514T;
	}

	/**
	 * set value for ei_06_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0601S
	 * @return Evalinstr
	 */
	public function &setEi0601S($ei0601S) {
		$this->notifyChanged(self::FIELD_EI_06_01_S,$this->ei0601S,$ei0601S);
		$this->ei0601S=$ei0601S;
		return $this;
	}

	/**
	 * get value for ei_06_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0601S() {
		return $this->ei0601S;
	}

	/**
	 * set value for ei_06_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0601T
	 * @return Evalinstr
	 */
	public function &setEi0601T($ei0601T) {
		$this->notifyChanged(self::FIELD_EI_06_01_T,$this->ei0601T,$ei0601T);
		$this->ei0601T=$ei0601T;
		return $this;
	}

	/**
	 * get value for ei_06_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0601T() {
		return $this->ei0601T;
	}

	/**
	 * set value for ei_06_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0602S
	 * @return Evalinstr
	 */
	public function &setEi0602S($ei0602S) {
		$this->notifyChanged(self::FIELD_EI_06_02_S,$this->ei0602S,$ei0602S);
		$this->ei0602S=$ei0602S;
		return $this;
	}

	/**
	 * get value for ei_06_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0602S() {
		return $this->ei0602S;
	}

	/**
	 * set value for ei_06_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0602T
	 * @return Evalinstr
	 */
	public function &setEi0602T($ei0602T) {
		$this->notifyChanged(self::FIELD_EI_06_02_T,$this->ei0602T,$ei0602T);
		$this->ei0602T=$ei0602T;
		return $this;
	}

	/**
	 * get value for ei_06_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0602T() {
		return $this->ei0602T;
	}

	/**
	 * set value for ei_06_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0603S
	 * @return Evalinstr
	 */
	public function &setEi0603S($ei0603S) {
		$this->notifyChanged(self::FIELD_EI_06_03_S,$this->ei0603S,$ei0603S);
		$this->ei0603S=$ei0603S;
		return $this;
	}

	/**
	 * get value for ei_06_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0603S() {
		return $this->ei0603S;
	}

	/**
	 * set value for ei_06_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0603T
	 * @return Evalinstr
	 */
	public function &setEi0603T($ei0603T) {
		$this->notifyChanged(self::FIELD_EI_06_03_T,$this->ei0603T,$ei0603T);
		$this->ei0603T=$ei0603T;
		return $this;
	}

	/**
	 * get value for ei_06_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0603T() {
		return $this->ei0603T;
	}

	/**
	 * set value for ei_06_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0604S
	 * @return Evalinstr
	 */
	public function &setEi0604S($ei0604S) {
		$this->notifyChanged(self::FIELD_EI_06_04_S,$this->ei0604S,$ei0604S);
		$this->ei0604S=$ei0604S;
		return $this;
	}

	/**
	 * get value for ei_06_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0604S() {
		return $this->ei0604S;
	}

	/**
	 * set value for ei_06_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0604T
	 * @return Evalinstr
	 */
	public function &setEi0604T($ei0604T) {
		$this->notifyChanged(self::FIELD_EI_06_04_T,$this->ei0604T,$ei0604T);
		$this->ei0604T=$ei0604T;
		return $this;
	}

	/**
	 * get value for ei_06_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0604T() {
		return $this->ei0604T;
	}

	/**
	 * set value for ei_06_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0605S
	 * @return Evalinstr
	 */
	public function &setEi0605S($ei0605S) {
		$this->notifyChanged(self::FIELD_EI_06_05_S,$this->ei0605S,$ei0605S);
		$this->ei0605S=$ei0605S;
		return $this;
	}

	/**
	 * get value for ei_06_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0605S() {
		return $this->ei0605S;
	}

	/**
	 * set value for ei_06_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0605T
	 * @return Evalinstr
	 */
	public function &setEi0605T($ei0605T) {
		$this->notifyChanged(self::FIELD_EI_06_05_T,$this->ei0605T,$ei0605T);
		$this->ei0605T=$ei0605T;
		return $this;
	}

	/**
	 * get value for ei_06_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0605T() {
		return $this->ei0605T;
	}

	/**
	 * set value for ei_06_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0606S
	 * @return Evalinstr
	 */
	public function &setEi0606S($ei0606S) {
		$this->notifyChanged(self::FIELD_EI_06_06_S,$this->ei0606S,$ei0606S);
		$this->ei0606S=$ei0606S;
		return $this;
	}

	/**
	 * get value for ei_06_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0606S() {
		return $this->ei0606S;
	}

	/**
	 * set value for ei_06_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0606T
	 * @return Evalinstr
	 */
	public function &setEi0606T($ei0606T) {
		$this->notifyChanged(self::FIELD_EI_06_06_T,$this->ei0606T,$ei0606T);
		$this->ei0606T=$ei0606T;
		return $this;
	}

	/**
	 * get value for ei_06_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0606T() {
		return $this->ei0606T;
	}

	/**
	 * set value for ei_06_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0607S
	 * @return Evalinstr
	 */
	public function &setEi0607S($ei0607S) {
		$this->notifyChanged(self::FIELD_EI_06_07_S,$this->ei0607S,$ei0607S);
		$this->ei0607S=$ei0607S;
		return $this;
	}

	/**
	 * get value for ei_06_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0607S() {
		return $this->ei0607S;
	}

	/**
	 * set value for ei_06_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0607T
	 * @return Evalinstr
	 */
	public function &setEi0607T($ei0607T) {
		$this->notifyChanged(self::FIELD_EI_06_07_T,$this->ei0607T,$ei0607T);
		$this->ei0607T=$ei0607T;
		return $this;
	}

	/**
	 * get value for ei_06_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0607T() {
		return $this->ei0607T;
	}

	/**
	 * set value for ei_06_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0608S
	 * @return Evalinstr
	 */
	public function &setEi0608S($ei0608S) {
		$this->notifyChanged(self::FIELD_EI_06_08_S,$this->ei0608S,$ei0608S);
		$this->ei0608S=$ei0608S;
		return $this;
	}

	/**
	 * get value for ei_06_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0608S() {
		return $this->ei0608S;
	}

	/**
	 * set value for ei_06_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0608T
	 * @return Evalinstr
	 */
	public function &setEi0608T($ei0608T) {
		$this->notifyChanged(self::FIELD_EI_06_08_T,$this->ei0608T,$ei0608T);
		$this->ei0608T=$ei0608T;
		return $this;
	}

	/**
	 * get value for ei_06_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0608T() {
		return $this->ei0608T;
	}

	/**
	 * set value for ei_06_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0609S
	 * @return Evalinstr
	 */
	public function &setEi0609S($ei0609S) {
		$this->notifyChanged(self::FIELD_EI_06_09_S,$this->ei0609S,$ei0609S);
		$this->ei0609S=$ei0609S;
		return $this;
	}

	/**
	 * get value for ei_06_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0609S() {
		return $this->ei0609S;
	}

	/**
	 * set value for ei_06_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0609T
	 * @return Evalinstr
	 */
	public function &setEi0609T($ei0609T) {
		$this->notifyChanged(self::FIELD_EI_06_09_T,$this->ei0609T,$ei0609T);
		$this->ei0609T=$ei0609T;
		return $this;
	}

	/**
	 * get value for ei_06_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0609T() {
		return $this->ei0609T;
	}

	/**
	 * set value for ei_06_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0610S
	 * @return Evalinstr
	 */
	public function &setEi0610S($ei0610S) {
		$this->notifyChanged(self::FIELD_EI_06_10_S,$this->ei0610S,$ei0610S);
		$this->ei0610S=$ei0610S;
		return $this;
	}

	/**
	 * get value for ei_06_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0610S() {
		return $this->ei0610S;
	}

	/**
	 * set value for ei_06_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0610T
	 * @return Evalinstr
	 */
	public function &setEi0610T($ei0610T) {
		$this->notifyChanged(self::FIELD_EI_06_10_T,$this->ei0610T,$ei0610T);
		$this->ei0610T=$ei0610T;
		return $this;
	}

	/**
	 * get value for ei_06_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0610T() {
		return $this->ei0610T;
	}

	/**
	 * set value for ei_06_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0611S
	 * @return Evalinstr
	 */
	public function &setEi0611S($ei0611S) {
		$this->notifyChanged(self::FIELD_EI_06_11_S,$this->ei0611S,$ei0611S);
		$this->ei0611S=$ei0611S;
		return $this;
	}

	/**
	 * get value for ei_06_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0611S() {
		return $this->ei0611S;
	}

	/**
	 * set value for ei_06_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0611T
	 * @return Evalinstr
	 */
	public function &setEi0611T($ei0611T) {
		$this->notifyChanged(self::FIELD_EI_06_11_T,$this->ei0611T,$ei0611T);
		$this->ei0611T=$ei0611T;
		return $this;
	}

	/**
	 * get value for ei_06_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0611T() {
		return $this->ei0611T;
	}

	/**
	 * set value for ei_07_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0701S
	 * @return Evalinstr
	 */
	public function &setEi0701S($ei0701S) {
		$this->notifyChanged(self::FIELD_EI_07_01_S,$this->ei0701S,$ei0701S);
		$this->ei0701S=$ei0701S;
		return $this;
	}

	/**
	 * get value for ei_07_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0701S() {
		return $this->ei0701S;
	}

	/**
	 * set value for ei_07_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0701T
	 * @return Evalinstr
	 */
	public function &setEi0701T($ei0701T) {
		$this->notifyChanged(self::FIELD_EI_07_01_T,$this->ei0701T,$ei0701T);
		$this->ei0701T=$ei0701T;
		return $this;
	}

	/**
	 * get value for ei_07_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0701T() {
		return $this->ei0701T;
	}

	/**
	 * set value for ei_07_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0702S
	 * @return Evalinstr
	 */
	public function &setEi0702S($ei0702S) {
		$this->notifyChanged(self::FIELD_EI_07_02_S,$this->ei0702S,$ei0702S);
		$this->ei0702S=$ei0702S;
		return $this;
	}

	/**
	 * get value for ei_07_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0702S() {
		return $this->ei0702S;
	}

	/**
	 * set value for ei_07_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0702T
	 * @return Evalinstr
	 */
	public function &setEi0702T($ei0702T) {
		$this->notifyChanged(self::FIELD_EI_07_02_T,$this->ei0702T,$ei0702T);
		$this->ei0702T=$ei0702T;
		return $this;
	}

	/**
	 * get value for ei_07_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0702T() {
		return $this->ei0702T;
	}

	/**
	 * set value for ei_07_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0703S
	 * @return Evalinstr
	 */
	public function &setEi0703S($ei0703S) {
		$this->notifyChanged(self::FIELD_EI_07_03_S,$this->ei0703S,$ei0703S);
		$this->ei0703S=$ei0703S;
		return $this;
	}

	/**
	 * get value for ei_07_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0703S() {
		return $this->ei0703S;
	}

	/**
	 * set value for ei_07_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0703T
	 * @return Evalinstr
	 */
	public function &setEi0703T($ei0703T) {
		$this->notifyChanged(self::FIELD_EI_07_03_T,$this->ei0703T,$ei0703T);
		$this->ei0703T=$ei0703T;
		return $this;
	}

	/**
	 * get value for ei_07_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0703T() {
		return $this->ei0703T;
	}

	/**
	 * set value for ei_07_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0704S
	 * @return Evalinstr
	 */
	public function &setEi0704S($ei0704S) {
		$this->notifyChanged(self::FIELD_EI_07_04_S,$this->ei0704S,$ei0704S);
		$this->ei0704S=$ei0704S;
		return $this;
	}

	/**
	 * get value for ei_07_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0704S() {
		return $this->ei0704S;
	}

	/**
	 * set value for ei_07_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0704T
	 * @return Evalinstr
	 */
	public function &setEi0704T($ei0704T) {
		$this->notifyChanged(self::FIELD_EI_07_04_T,$this->ei0704T,$ei0704T);
		$this->ei0704T=$ei0704T;
		return $this;
	}

	/**
	 * get value for ei_07_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0704T() {
		return $this->ei0704T;
	}

	/**
	 * set value for ei_07_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0705S
	 * @return Evalinstr
	 */
	public function &setEi0705S($ei0705S) {
		$this->notifyChanged(self::FIELD_EI_07_05_S,$this->ei0705S,$ei0705S);
		$this->ei0705S=$ei0705S;
		return $this;
	}

	/**
	 * get value for ei_07_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0705S() {
		return $this->ei0705S;
	}

	/**
	 * set value for ei_07_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0705T
	 * @return Evalinstr
	 */
	public function &setEi0705T($ei0705T) {
		$this->notifyChanged(self::FIELD_EI_07_05_T,$this->ei0705T,$ei0705T);
		$this->ei0705T=$ei0705T;
		return $this;
	}

	/**
	 * get value for ei_07_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0705T() {
		return $this->ei0705T;
	}

	/**
	 * set value for ei_07_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0706S
	 * @return Evalinstr
	 */
	public function &setEi0706S($ei0706S) {
		$this->notifyChanged(self::FIELD_EI_07_06_S,$this->ei0706S,$ei0706S);
		$this->ei0706S=$ei0706S;
		return $this;
	}

	/**
	 * get value for ei_07_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0706S() {
		return $this->ei0706S;
	}

	/**
	 * set value for ei_07_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0706T
	 * @return Evalinstr
	 */
	public function &setEi0706T($ei0706T) {
		$this->notifyChanged(self::FIELD_EI_07_06_T,$this->ei0706T,$ei0706T);
		$this->ei0706T=$ei0706T;
		return $this;
	}

	/**
	 * get value for ei_07_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0706T() {
		return $this->ei0706T;
	}

	/**
	 * set value for ei_07_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0707S
	 * @return Evalinstr
	 */
	public function &setEi0707S($ei0707S) {
		$this->notifyChanged(self::FIELD_EI_07_07_S,$this->ei0707S,$ei0707S);
		$this->ei0707S=$ei0707S;
		return $this;
	}

	/**
	 * get value for ei_07_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0707S() {
		return $this->ei0707S;
	}

	/**
	 * set value for ei_07_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0707T
	 * @return Evalinstr
	 */
	public function &setEi0707T($ei0707T) {
		$this->notifyChanged(self::FIELD_EI_07_07_T,$this->ei0707T,$ei0707T);
		$this->ei0707T=$ei0707T;
		return $this;
	}

	/**
	 * get value for ei_07_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0707T() {
		return $this->ei0707T;
	}

	/**
	 * set value for ei_07_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei0708S
	 * @return Evalinstr
	 */
	public function &setEi0708S($ei0708S) {
		$this->notifyChanged(self::FIELD_EI_07_08_S,$this->ei0708S,$ei0708S);
		$this->ei0708S=$ei0708S;
		return $this;
	}

	/**
	 * get value for ei_07_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi0708S() {
		return $this->ei0708S;
	}

	/**
	 * set value for ei_07_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei0708T
	 * @return Evalinstr
	 */
	public function &setEi0708T($ei0708T) {
		$this->notifyChanged(self::FIELD_EI_07_08_T,$this->ei0708T,$ei0708T);
		$this->ei0708T=$ei0708T;
		return $this;
	}

	/**
	 * get value for ei_07_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi0708T() {
		return $this->ei0708T;
	}

	/**
	 * set value for ei_081_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08101S
	 * @return Evalinstr
	 */
	public function &setEi08101S($ei08101S) {
		$this->notifyChanged(self::FIELD_EI_081_01_S,$this->ei08101S,$ei08101S);
		$this->ei08101S=$ei08101S;
		return $this;
	}

	/**
	 * get value for ei_081_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08101S() {
		return $this->ei08101S;
	}

	/**
	 * set value for ei_081_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08101T
	 * @return Evalinstr
	 */
	public function &setEi08101T($ei08101T) {
		$this->notifyChanged(self::FIELD_EI_081_01_T,$this->ei08101T,$ei08101T);
		$this->ei08101T=$ei08101T;
		return $this;
	}

	/**
	 * get value for ei_081_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08101T() {
		return $this->ei08101T;
	}

	/**
	 * set value for ei_081_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08102S
	 * @return Evalinstr
	 */
	public function &setEi08102S($ei08102S) {
		$this->notifyChanged(self::FIELD_EI_081_02_S,$this->ei08102S,$ei08102S);
		$this->ei08102S=$ei08102S;
		return $this;
	}

	/**
	 * get value for ei_081_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08102S() {
		return $this->ei08102S;
	}

	/**
	 * set value for ei_081_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08102T
	 * @return Evalinstr
	 */
	public function &setEi08102T($ei08102T) {
		$this->notifyChanged(self::FIELD_EI_081_02_T,$this->ei08102T,$ei08102T);
		$this->ei08102T=$ei08102T;
		return $this;
	}

	/**
	 * get value for ei_081_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08102T() {
		return $this->ei08102T;
	}

	/**
	 * set value for ei_081_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08103S
	 * @return Evalinstr
	 */
	public function &setEi08103S($ei08103S) {
		$this->notifyChanged(self::FIELD_EI_081_03_S,$this->ei08103S,$ei08103S);
		$this->ei08103S=$ei08103S;
		return $this;
	}

	/**
	 * get value for ei_081_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08103S() {
		return $this->ei08103S;
	}

	/**
	 * set value for ei_081_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08103T
	 * @return Evalinstr
	 */
	public function &setEi08103T($ei08103T) {
		$this->notifyChanged(self::FIELD_EI_081_03_T,$this->ei08103T,$ei08103T);
		$this->ei08103T=$ei08103T;
		return $this;
	}

	/**
	 * get value for ei_081_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08103T() {
		return $this->ei08103T;
	}

	/**
	 * set value for ei_081_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08104S
	 * @return Evalinstr
	 */
	public function &setEi08104S($ei08104S) {
		$this->notifyChanged(self::FIELD_EI_081_04_S,$this->ei08104S,$ei08104S);
		$this->ei08104S=$ei08104S;
		return $this;
	}

	/**
	 * get value for ei_081_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08104S() {
		return $this->ei08104S;
	}

	/**
	 * set value for ei_081_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08104T
	 * @return Evalinstr
	 */
	public function &setEi08104T($ei08104T) {
		$this->notifyChanged(self::FIELD_EI_081_04_T,$this->ei08104T,$ei08104T);
		$this->ei08104T=$ei08104T;
		return $this;
	}

	/**
	 * get value for ei_081_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08104T() {
		return $this->ei08104T;
	}

	/**
	 * set value for ei_081_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08105S
	 * @return Evalinstr
	 */
	public function &setEi08105S($ei08105S) {
		$this->notifyChanged(self::FIELD_EI_081_05_S,$this->ei08105S,$ei08105S);
		$this->ei08105S=$ei08105S;
		return $this;
	}

	/**
	 * get value for ei_081_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08105S() {
		return $this->ei08105S;
	}

	/**
	 * set value for ei_081_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08105T
	 * @return Evalinstr
	 */
	public function &setEi08105T($ei08105T) {
		$this->notifyChanged(self::FIELD_EI_081_05_T,$this->ei08105T,$ei08105T);
		$this->ei08105T=$ei08105T;
		return $this;
	}

	/**
	 * get value for ei_081_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08105T() {
		return $this->ei08105T;
	}

	/**
	 * set value for ei_081_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08106S
	 * @return Evalinstr
	 */
	public function &setEi08106S($ei08106S) {
		$this->notifyChanged(self::FIELD_EI_081_06_S,$this->ei08106S,$ei08106S);
		$this->ei08106S=$ei08106S;
		return $this;
	}

	/**
	 * get value for ei_081_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08106S() {
		return $this->ei08106S;
	}

	/**
	 * set value for ei_081_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08106T
	 * @return Evalinstr
	 */
	public function &setEi08106T($ei08106T) {
		$this->notifyChanged(self::FIELD_EI_081_06_T,$this->ei08106T,$ei08106T);
		$this->ei08106T=$ei08106T;
		return $this;
	}

	/**
	 * get value for ei_081_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08106T() {
		return $this->ei08106T;
	}

	/**
	 * set value for ei_081_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08107S
	 * @return Evalinstr
	 */
	public function &setEi08107S($ei08107S) {
		$this->notifyChanged(self::FIELD_EI_081_07_S,$this->ei08107S,$ei08107S);
		$this->ei08107S=$ei08107S;
		return $this;
	}

	/**
	 * get value for ei_081_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08107S() {
		return $this->ei08107S;
	}

	/**
	 * set value for ei_081_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08107T
	 * @return Evalinstr
	 */
	public function &setEi08107T($ei08107T) {
		$this->notifyChanged(self::FIELD_EI_081_07_T,$this->ei08107T,$ei08107T);
		$this->ei08107T=$ei08107T;
		return $this;
	}

	/**
	 * get value for ei_081_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08107T() {
		return $this->ei08107T;
	}

	/**
	 * set value for ei_081_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08108S
	 * @return Evalinstr
	 */
	public function &setEi08108S($ei08108S) {
		$this->notifyChanged(self::FIELD_EI_081_08_S,$this->ei08108S,$ei08108S);
		$this->ei08108S=$ei08108S;
		return $this;
	}

	/**
	 * get value for ei_081_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08108S() {
		return $this->ei08108S;
	}

	/**
	 * set value for ei_081_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08108T
	 * @return Evalinstr
	 */
	public function &setEi08108T($ei08108T) {
		$this->notifyChanged(self::FIELD_EI_081_08_T,$this->ei08108T,$ei08108T);
		$this->ei08108T=$ei08108T;
		return $this;
	}

	/**
	 * get value for ei_081_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08108T() {
		return $this->ei08108T;
	}

	/**
	 * set value for ei_081_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08109S
	 * @return Evalinstr
	 */
	public function &setEi08109S($ei08109S) {
		$this->notifyChanged(self::FIELD_EI_081_09_S,$this->ei08109S,$ei08109S);
		$this->ei08109S=$ei08109S;
		return $this;
	}

	/**
	 * get value for ei_081_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08109S() {
		return $this->ei08109S;
	}

	/**
	 * set value for ei_081_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08109T
	 * @return Evalinstr
	 */
	public function &setEi08109T($ei08109T) {
		$this->notifyChanged(self::FIELD_EI_081_09_T,$this->ei08109T,$ei08109T);
		$this->ei08109T=$ei08109T;
		return $this;
	}

	/**
	 * get value for ei_081_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08109T() {
		return $this->ei08109T;
	}

	/**
	 * set value for ei_081_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08110S
	 * @return Evalinstr
	 */
	public function &setEi08110S($ei08110S) {
		$this->notifyChanged(self::FIELD_EI_081_10_S,$this->ei08110S,$ei08110S);
		$this->ei08110S=$ei08110S;
		return $this;
	}

	/**
	 * get value for ei_081_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08110S() {
		return $this->ei08110S;
	}

	/**
	 * set value for ei_081_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08110T
	 * @return Evalinstr
	 */
	public function &setEi08110T($ei08110T) {
		$this->notifyChanged(self::FIELD_EI_081_10_T,$this->ei08110T,$ei08110T);
		$this->ei08110T=$ei08110T;
		return $this;
	}

	/**
	 * get value for ei_081_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08110T() {
		return $this->ei08110T;
	}

	/**
	 * set value for ei_081_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08111S
	 * @return Evalinstr
	 */
	public function &setEi08111S($ei08111S) {
		$this->notifyChanged(self::FIELD_EI_081_11_S,$this->ei08111S,$ei08111S);
		$this->ei08111S=$ei08111S;
		return $this;
	}

	/**
	 * get value for ei_081_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08111S() {
		return $this->ei08111S;
	}

	/**
	 * set value for ei_081_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08111T
	 * @return Evalinstr
	 */
	public function &setEi08111T($ei08111T) {
		$this->notifyChanged(self::FIELD_EI_081_11_T,$this->ei08111T,$ei08111T);
		$this->ei08111T=$ei08111T;
		return $this;
	}

	/**
	 * get value for ei_081_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08111T() {
		return $this->ei08111T;
	}

	/**
	 * set value for ei_081_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08112S
	 * @return Evalinstr
	 */
	public function &setEi08112S($ei08112S) {
		$this->notifyChanged(self::FIELD_EI_081_12_S,$this->ei08112S,$ei08112S);
		$this->ei08112S=$ei08112S;
		return $this;
	}

	/**
	 * get value for ei_081_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08112S() {
		return $this->ei08112S;
	}

	/**
	 * set value for ei_081_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08112T
	 * @return Evalinstr
	 */
	public function &setEi08112T($ei08112T) {
		$this->notifyChanged(self::FIELD_EI_081_12_T,$this->ei08112T,$ei08112T);
		$this->ei08112T=$ei08112T;
		return $this;
	}

	/**
	 * get value for ei_081_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08112T() {
		return $this->ei08112T;
	}

	/**
	 * set value for ei_081_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08113S
	 * @return Evalinstr
	 */
	public function &setEi08113S($ei08113S) {
		$this->notifyChanged(self::FIELD_EI_081_13_S,$this->ei08113S,$ei08113S);
		$this->ei08113S=$ei08113S;
		return $this;
	}

	/**
	 * get value for ei_081_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08113S() {
		return $this->ei08113S;
	}

	/**
	 * set value for ei_081_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08113T
	 * @return Evalinstr
	 */
	public function &setEi08113T($ei08113T) {
		$this->notifyChanged(self::FIELD_EI_081_13_T,$this->ei08113T,$ei08113T);
		$this->ei08113T=$ei08113T;
		return $this;
	}

	/**
	 * get value for ei_081_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08113T() {
		return $this->ei08113T;
	}

	/**
	 * set value for ei_081_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08114S
	 * @return Evalinstr
	 */
	public function &setEi08114S($ei08114S) {
		$this->notifyChanged(self::FIELD_EI_081_14_S,$this->ei08114S,$ei08114S);
		$this->ei08114S=$ei08114S;
		return $this;
	}

	/**
	 * get value for ei_081_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08114S() {
		return $this->ei08114S;
	}

	/**
	 * set value for ei_081_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08114T
	 * @return Evalinstr
	 */
	public function &setEi08114T($ei08114T) {
		$this->notifyChanged(self::FIELD_EI_081_14_T,$this->ei08114T,$ei08114T);
		$this->ei08114T=$ei08114T;
		return $this;
	}

	/**
	 * get value for ei_081_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08114T() {
		return $this->ei08114T;
	}

	/**
	 * set value for ei_081_15_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08115S
	 * @return Evalinstr
	 */
	public function &setEi08115S($ei08115S) {
		$this->notifyChanged(self::FIELD_EI_081_15_S,$this->ei08115S,$ei08115S);
		$this->ei08115S=$ei08115S;
		return $this;
	}

	/**
	 * get value for ei_081_15_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08115S() {
		return $this->ei08115S;
	}

	/**
	 * set value for ei_081_15_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08115T
	 * @return Evalinstr
	 */
	public function &setEi08115T($ei08115T) {
		$this->notifyChanged(self::FIELD_EI_081_15_T,$this->ei08115T,$ei08115T);
		$this->ei08115T=$ei08115T;
		return $this;
	}

	/**
	 * get value for ei_081_15_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08115T() {
		return $this->ei08115T;
	}

	/**
	 * set value for ei_081_16_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08116S
	 * @return Evalinstr
	 */
	public function &setEi08116S($ei08116S) {
		$this->notifyChanged(self::FIELD_EI_081_16_S,$this->ei08116S,$ei08116S);
		$this->ei08116S=$ei08116S;
		return $this;
	}

	/**
	 * get value for ei_081_16_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08116S() {
		return $this->ei08116S;
	}

	/**
	 * set value for ei_081_16_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08116T
	 * @return Evalinstr
	 */
	public function &setEi08116T($ei08116T) {
		$this->notifyChanged(self::FIELD_EI_081_16_T,$this->ei08116T,$ei08116T);
		$this->ei08116T=$ei08116T;
		return $this;
	}

	/**
	 * get value for ei_081_16_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08116T() {
		return $this->ei08116T;
	}

	/**
	 * set value for ei_081_17_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08117S
	 * @return Evalinstr
	 */
	public function &setEi08117S($ei08117S) {
		$this->notifyChanged(self::FIELD_EI_081_17_S,$this->ei08117S,$ei08117S);
		$this->ei08117S=$ei08117S;
		return $this;
	}

	/**
	 * get value for ei_081_17_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08117S() {
		return $this->ei08117S;
	}

	/**
	 * set value for ei_081_17_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08117T
	 * @return Evalinstr
	 */
	public function &setEi08117T($ei08117T) {
		$this->notifyChanged(self::FIELD_EI_081_17_T,$this->ei08117T,$ei08117T);
		$this->ei08117T=$ei08117T;
		return $this;
	}

	/**
	 * get value for ei_081_17_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08117T() {
		return $this->ei08117T;
	}

	/**
	 * set value for ei_081_18_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08118S
	 * @return Evalinstr
	 */
	public function &setEi08118S($ei08118S) {
		$this->notifyChanged(self::FIELD_EI_081_18_S,$this->ei08118S,$ei08118S);
		$this->ei08118S=$ei08118S;
		return $this;
	}

	/**
	 * get value for ei_081_18_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08118S() {
		return $this->ei08118S;
	}

	/**
	 * set value for ei_081_18_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08118T
	 * @return Evalinstr
	 */
	public function &setEi08118T($ei08118T) {
		$this->notifyChanged(self::FIELD_EI_081_18_T,$this->ei08118T,$ei08118T);
		$this->ei08118T=$ei08118T;
		return $this;
	}

	/**
	 * get value for ei_081_18_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08118T() {
		return $this->ei08118T;
	}

	/**
	 * set value for ei_081_19_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08119S
	 * @return Evalinstr
	 */
	public function &setEi08119S($ei08119S) {
		$this->notifyChanged(self::FIELD_EI_081_19_S,$this->ei08119S,$ei08119S);
		$this->ei08119S=$ei08119S;
		return $this;
	}

	/**
	 * get value for ei_081_19_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08119S() {
		return $this->ei08119S;
	}

	/**
	 * set value for ei_081_19_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08119T
	 * @return Evalinstr
	 */
	public function &setEi08119T($ei08119T) {
		$this->notifyChanged(self::FIELD_EI_081_19_T,$this->ei08119T,$ei08119T);
		$this->ei08119T=$ei08119T;
		return $this;
	}

	/**
	 * get value for ei_081_19_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08119T() {
		return $this->ei08119T;
	}

	/**
	 * set value for ei_082_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08201S
	 * @return Evalinstr
	 */
	public function &setEi08201S($ei08201S) {
		$this->notifyChanged(self::FIELD_EI_082_01_S,$this->ei08201S,$ei08201S);
		$this->ei08201S=$ei08201S;
		return $this;
	}

	/**
	 * get value for ei_082_01_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08201S() {
		return $this->ei08201S;
	}

	/**
	 * set value for ei_082_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08201T
	 * @return Evalinstr
	 */
	public function &setEi08201T($ei08201T) {
		$this->notifyChanged(self::FIELD_EI_082_01_T,$this->ei08201T,$ei08201T);
		$this->ei08201T=$ei08201T;
		return $this;
	}

	/**
	 * get value for ei_082_01_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08201T() {
		return $this->ei08201T;
	}

	/**
	 * set value for ei_082_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08202S
	 * @return Evalinstr
	 */
	public function &setEi08202S($ei08202S) {
		$this->notifyChanged(self::FIELD_EI_082_02_S,$this->ei08202S,$ei08202S);
		$this->ei08202S=$ei08202S;
		return $this;
	}

	/**
	 * get value for ei_082_02_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08202S() {
		return $this->ei08202S;
	}

	/**
	 * set value for ei_082_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08202T
	 * @return Evalinstr
	 */
	public function &setEi08202T($ei08202T) {
		$this->notifyChanged(self::FIELD_EI_082_02_T,$this->ei08202T,$ei08202T);
		$this->ei08202T=$ei08202T;
		return $this;
	}

	/**
	 * get value for ei_082_02_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08202T() {
		return $this->ei08202T;
	}

	/**
	 * set value for ei_082_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08203S
	 * @return Evalinstr
	 */
	public function &setEi08203S($ei08203S) {
		$this->notifyChanged(self::FIELD_EI_082_03_S,$this->ei08203S,$ei08203S);
		$this->ei08203S=$ei08203S;
		return $this;
	}

	/**
	 * get value for ei_082_03_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08203S() {
		return $this->ei08203S;
	}

	/**
	 * set value for ei_082_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08203T
	 * @return Evalinstr
	 */
	public function &setEi08203T($ei08203T) {
		$this->notifyChanged(self::FIELD_EI_082_03_T,$this->ei08203T,$ei08203T);
		$this->ei08203T=$ei08203T;
		return $this;
	}

	/**
	 * get value for ei_082_03_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08203T() {
		return $this->ei08203T;
	}

	/**
	 * set value for ei_082_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08204S
	 * @return Evalinstr
	 */
	public function &setEi08204S($ei08204S) {
		$this->notifyChanged(self::FIELD_EI_082_04_S,$this->ei08204S,$ei08204S);
		$this->ei08204S=$ei08204S;
		return $this;
	}

	/**
	 * get value for ei_082_04_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08204S() {
		return $this->ei08204S;
	}

	/**
	 * set value for ei_082_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08204T
	 * @return Evalinstr
	 */
	public function &setEi08204T($ei08204T) {
		$this->notifyChanged(self::FIELD_EI_082_04_T,$this->ei08204T,$ei08204T);
		$this->ei08204T=$ei08204T;
		return $this;
	}

	/**
	 * get value for ei_082_04_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08204T() {
		return $this->ei08204T;
	}

	/**
	 * set value for ei_082_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08205S
	 * @return Evalinstr
	 */
	public function &setEi08205S($ei08205S) {
		$this->notifyChanged(self::FIELD_EI_082_05_S,$this->ei08205S,$ei08205S);
		$this->ei08205S=$ei08205S;
		return $this;
	}

	/**
	 * get value for ei_082_05_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08205S() {
		return $this->ei08205S;
	}

	/**
	 * set value for ei_082_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08205T
	 * @return Evalinstr
	 */
	public function &setEi08205T($ei08205T) {
		$this->notifyChanged(self::FIELD_EI_082_05_T,$this->ei08205T,$ei08205T);
		$this->ei08205T=$ei08205T;
		return $this;
	}

	/**
	 * get value for ei_082_05_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08205T() {
		return $this->ei08205T;
	}

	/**
	 * set value for ei_082_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08206S
	 * @return Evalinstr
	 */
	public function &setEi08206S($ei08206S) {
		$this->notifyChanged(self::FIELD_EI_082_06_S,$this->ei08206S,$ei08206S);
		$this->ei08206S=$ei08206S;
		return $this;
	}

	/**
	 * get value for ei_082_06_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08206S() {
		return $this->ei08206S;
	}

	/**
	 * set value for ei_082_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08206T
	 * @return Evalinstr
	 */
	public function &setEi08206T($ei08206T) {
		$this->notifyChanged(self::FIELD_EI_082_06_T,$this->ei08206T,$ei08206T);
		$this->ei08206T=$ei08206T;
		return $this;
	}

	/**
	 * get value for ei_082_06_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08206T() {
		return $this->ei08206T;
	}

	/**
	 * set value for ei_082_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08207S
	 * @return Evalinstr
	 */
	public function &setEi08207S($ei08207S) {
		$this->notifyChanged(self::FIELD_EI_082_07_S,$this->ei08207S,$ei08207S);
		$this->ei08207S=$ei08207S;
		return $this;
	}

	/**
	 * get value for ei_082_07_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08207S() {
		return $this->ei08207S;
	}

	/**
	 * set value for ei_082_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08207T
	 * @return Evalinstr
	 */
	public function &setEi08207T($ei08207T) {
		$this->notifyChanged(self::FIELD_EI_082_07_T,$this->ei08207T,$ei08207T);
		$this->ei08207T=$ei08207T;
		return $this;
	}

	/**
	 * get value for ei_082_07_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08207T() {
		return $this->ei08207T;
	}

	/**
	 * set value for ei_082_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08208S
	 * @return Evalinstr
	 */
	public function &setEi08208S($ei08208S) {
		$this->notifyChanged(self::FIELD_EI_082_08_S,$this->ei08208S,$ei08208S);
		$this->ei08208S=$ei08208S;
		return $this;
	}

	/**
	 * get value for ei_082_08_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08208S() {
		return $this->ei08208S;
	}

	/**
	 * set value for ei_082_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08208T
	 * @return Evalinstr
	 */
	public function &setEi08208T($ei08208T) {
		$this->notifyChanged(self::FIELD_EI_082_08_T,$this->ei08208T,$ei08208T);
		$this->ei08208T=$ei08208T;
		return $this;
	}

	/**
	 * get value for ei_082_08_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08208T() {
		return $this->ei08208T;
	}

	/**
	 * set value for ei_082_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08209S
	 * @return Evalinstr
	 */
	public function &setEi08209S($ei08209S) {
		$this->notifyChanged(self::FIELD_EI_082_09_S,$this->ei08209S,$ei08209S);
		$this->ei08209S=$ei08209S;
		return $this;
	}

	/**
	 * get value for ei_082_09_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08209S() {
		return $this->ei08209S;
	}

	/**
	 * set value for ei_082_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08209T
	 * @return Evalinstr
	 */
	public function &setEi08209T($ei08209T) {
		$this->notifyChanged(self::FIELD_EI_082_09_T,$this->ei08209T,$ei08209T);
		$this->ei08209T=$ei08209T;
		return $this;
	}

	/**
	 * get value for ei_082_09_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08209T() {
		return $this->ei08209T;
	}

	/**
	 * set value for ei_082_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08210S
	 * @return Evalinstr
	 */
	public function &setEi08210S($ei08210S) {
		$this->notifyChanged(self::FIELD_EI_082_10_S,$this->ei08210S,$ei08210S);
		$this->ei08210S=$ei08210S;
		return $this;
	}

	/**
	 * get value for ei_082_10_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08210S() {
		return $this->ei08210S;
	}

	/**
	 * set value for ei_082_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08210T
	 * @return Evalinstr
	 */
	public function &setEi08210T($ei08210T) {
		$this->notifyChanged(self::FIELD_EI_082_10_T,$this->ei08210T,$ei08210T);
		$this->ei08210T=$ei08210T;
		return $this;
	}

	/**
	 * get value for ei_082_10_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08210T() {
		return $this->ei08210T;
	}

	/**
	 * set value for ei_082_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08211S
	 * @return Evalinstr
	 */
	public function &setEi08211S($ei08211S) {
		$this->notifyChanged(self::FIELD_EI_082_11_S,$this->ei08211S,$ei08211S);
		$this->ei08211S=$ei08211S;
		return $this;
	}

	/**
	 * get value for ei_082_11_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08211S() {
		return $this->ei08211S;
	}

	/**
	 * set value for ei_082_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08211T
	 * @return Evalinstr
	 */
	public function &setEi08211T($ei08211T) {
		$this->notifyChanged(self::FIELD_EI_082_11_T,$this->ei08211T,$ei08211T);
		$this->ei08211T=$ei08211T;
		return $this;
	}

	/**
	 * get value for ei_082_11_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08211T() {
		return $this->ei08211T;
	}

	/**
	 * set value for ei_082_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08212S
	 * @return Evalinstr
	 */
	public function &setEi08212S($ei08212S) {
		$this->notifyChanged(self::FIELD_EI_082_12_S,$this->ei08212S,$ei08212S);
		$this->ei08212S=$ei08212S;
		return $this;
	}

	/**
	 * get value for ei_082_12_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08212S() {
		return $this->ei08212S;
	}

	/**
	 * set value for ei_082_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08212T
	 * @return Evalinstr
	 */
	public function &setEi08212T($ei08212T) {
		$this->notifyChanged(self::FIELD_EI_082_12_T,$this->ei08212T,$ei08212T);
		$this->ei08212T=$ei08212T;
		return $this;
	}

	/**
	 * get value for ei_082_12_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08212T() {
		return $this->ei08212T;
	}

	/**
	 * set value for ei_082_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08213S
	 * @return Evalinstr
	 */
	public function &setEi08213S($ei08213S) {
		$this->notifyChanged(self::FIELD_EI_082_13_S,$this->ei08213S,$ei08213S);
		$this->ei08213S=$ei08213S;
		return $this;
	}

	/**
	 * get value for ei_082_13_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08213S() {
		return $this->ei08213S;
	}

	/**
	 * set value for ei_082_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08213T
	 * @return Evalinstr
	 */
	public function &setEi08213T($ei08213T) {
		$this->notifyChanged(self::FIELD_EI_082_13_T,$this->ei08213T,$ei08213T);
		$this->ei08213T=$ei08213T;
		return $this;
	}

	/**
	 * get value for ei_082_13_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08213T() {
		return $this->ei08213T;
	}

	/**
	 * set value for ei_082_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08214S
	 * @return Evalinstr
	 */
	public function &setEi08214S($ei08214S) {
		$this->notifyChanged(self::FIELD_EI_082_14_S,$this->ei08214S,$ei08214S);
		$this->ei08214S=$ei08214S;
		return $this;
	}

	/**
	 * get value for ei_082_14_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08214S() {
		return $this->ei08214S;
	}

	/**
	 * set value for ei_082_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08214T
	 * @return Evalinstr
	 */
	public function &setEi08214T($ei08214T) {
		$this->notifyChanged(self::FIELD_EI_082_14_T,$this->ei08214T,$ei08214T);
		$this->ei08214T=$ei08214T;
		return $this;
	}

	/**
	 * get value for ei_082_14_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08214T() {
		return $this->ei08214T;
	}

	/**
	 * set value for ei_082_15_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08215S
	 * @return Evalinstr
	 */
	public function &setEi08215S($ei08215S) {
		$this->notifyChanged(self::FIELD_EI_082_15_S,$this->ei08215S,$ei08215S);
		$this->ei08215S=$ei08215S;
		return $this;
	}

	/**
	 * get value for ei_082_15_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08215S() {
		return $this->ei08215S;
	}

	/**
	 * set value for ei_082_15_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08215T
	 * @return Evalinstr
	 */
	public function &setEi08215T($ei08215T) {
		$this->notifyChanged(self::FIELD_EI_082_15_T,$this->ei08215T,$ei08215T);
		$this->ei08215T=$ei08215T;
		return $this;
	}

	/**
	 * get value for ei_082_15_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08215T() {
		return $this->ei08215T;
	}

	/**
	 * set value for ei_082_16_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08216S
	 * @return Evalinstr
	 */
	public function &setEi08216S($ei08216S) {
		$this->notifyChanged(self::FIELD_EI_082_16_S,$this->ei08216S,$ei08216S);
		$this->ei08216S=$ei08216S;
		return $this;
	}

	/**
	 * get value for ei_082_16_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08216S() {
		return $this->ei08216S;
	}

	/**
	 * set value for ei_082_16_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08216T
	 * @return Evalinstr
	 */
	public function &setEi08216T($ei08216T) {
		$this->notifyChanged(self::FIELD_EI_082_16_T,$this->ei08216T,$ei08216T);
		$this->ei08216T=$ei08216T;
		return $this;
	}

	/**
	 * get value for ei_082_16_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08216T() {
		return $this->ei08216T;
	}

	/**
	 * set value for ei_082_17_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08217S
	 * @return Evalinstr
	 */
	public function &setEi08217S($ei08217S) {
		$this->notifyChanged(self::FIELD_EI_082_17_S,$this->ei08217S,$ei08217S);
		$this->ei08217S=$ei08217S;
		return $this;
	}

	/**
	 * get value for ei_082_17_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08217S() {
		return $this->ei08217S;
	}

	/**
	 * set value for ei_082_17_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08217T
	 * @return Evalinstr
	 */
	public function &setEi08217T($ei08217T) {
		$this->notifyChanged(self::FIELD_EI_082_17_T,$this->ei08217T,$ei08217T);
		$this->ei08217T=$ei08217T;
		return $this;
	}

	/**
	 * get value for ei_082_17_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08217T() {
		return $this->ei08217T;
	}

	/**
	 * set value for ei_082_18_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08218S
	 * @return Evalinstr
	 */
	public function &setEi08218S($ei08218S) {
		$this->notifyChanged(self::FIELD_EI_082_18_S,$this->ei08218S,$ei08218S);
		$this->ei08218S=$ei08218S;
		return $this;
	}

	/**
	 * get value for ei_082_18_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08218S() {
		return $this->ei08218S;
	}

	/**
	 * set value for ei_082_18_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08218T
	 * @return Evalinstr
	 */
	public function &setEi08218T($ei08218T) {
		$this->notifyChanged(self::FIELD_EI_082_18_T,$this->ei08218T,$ei08218T);
		$this->ei08218T=$ei08218T;
		return $this;
	}

	/**
	 * get value for ei_082_18_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08218T() {
		return $this->ei08218T;
	}

	/**
	 * set value for ei_082_19_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08219S
	 * @return Evalinstr
	 */
	public function &setEi08219S($ei08219S) {
		$this->notifyChanged(self::FIELD_EI_082_19_S,$this->ei08219S,$ei08219S);
		$this->ei08219S=$ei08219S;
		return $this;
	}

	/**
	 * get value for ei_082_19_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08219S() {
		return $this->ei08219S;
	}

	/**
	 * set value for ei_082_19_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08219T
	 * @return Evalinstr
	 */
	public function &setEi08219T($ei08219T) {
		$this->notifyChanged(self::FIELD_EI_082_19_T,$this->ei08219T,$ei08219T);
		$this->ei08219T=$ei08219T;
		return $this;
	}

	/**
	 * get value for ei_082_19_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08219T() {
		return $this->ei08219T;
	}

	/**
	 * set value for ei_082_20_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08220S
	 * @return Evalinstr
	 */
	public function &setEi08220S($ei08220S) {
		$this->notifyChanged(self::FIELD_EI_082_20_S,$this->ei08220S,$ei08220S);
		$this->ei08220S=$ei08220S;
		return $this;
	}

	/**
	 * get value for ei_082_20_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08220S() {
		return $this->ei08220S;
	}

	/**
	 * set value for ei_082_20_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08220T
	 * @return Evalinstr
	 */
	public function &setEi08220T($ei08220T) {
		$this->notifyChanged(self::FIELD_EI_082_20_T,$this->ei08220T,$ei08220T);
		$this->ei08220T=$ei08220T;
		return $this;
	}

	/**
	 * get value for ei_082_20_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08220T() {
		return $this->ei08220T;
	}

	/**
	 * set value for ei_082_21_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08221S
	 * @return Evalinstr
	 */
	public function &setEi08221S($ei08221S) {
		$this->notifyChanged(self::FIELD_EI_082_21_S,$this->ei08221S,$ei08221S);
		$this->ei08221S=$ei08221S;
		return $this;
	}

	/**
	 * get value for ei_082_21_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08221S() {
		return $this->ei08221S;
	}

	/**
	 * set value for ei_082_21_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08221T
	 * @return Evalinstr
	 */
	public function &setEi08221T($ei08221T) {
		$this->notifyChanged(self::FIELD_EI_082_21_T,$this->ei08221T,$ei08221T);
		$this->ei08221T=$ei08221T;
		return $this;
	}

	/**
	 * get value for ei_082_21_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08221T() {
		return $this->ei08221T;
	}

	/**
	 * set value for ei_082_22_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08222S
	 * @return Evalinstr
	 */
	public function &setEi08222S($ei08222S) {
		$this->notifyChanged(self::FIELD_EI_082_22_S,$this->ei08222S,$ei08222S);
		$this->ei08222S=$ei08222S;
		return $this;
	}

	/**
	 * get value for ei_082_22_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08222S() {
		return $this->ei08222S;
	}

	/**
	 * set value for ei_082_22_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08222T
	 * @return Evalinstr
	 */
	public function &setEi08222T($ei08222T) {
		$this->notifyChanged(self::FIELD_EI_082_22_T,$this->ei08222T,$ei08222T);
		$this->ei08222T=$ei08222T;
		return $this;
	}

	/**
	 * get value for ei_082_22_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08222T() {
		return $this->ei08222T;
	}

	/**
	 * set value for ei_082_23_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08223S
	 * @return Evalinstr
	 */
	public function &setEi08223S($ei08223S) {
		$this->notifyChanged(self::FIELD_EI_082_23_S,$this->ei08223S,$ei08223S);
		$this->ei08223S=$ei08223S;
		return $this;
	}

	/**
	 * get value for ei_082_23_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08223S() {
		return $this->ei08223S;
	}

	/**
	 * set value for ei_082_23_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08223T
	 * @return Evalinstr
	 */
	public function &setEi08223T($ei08223T) {
		$this->notifyChanged(self::FIELD_EI_082_23_T,$this->ei08223T,$ei08223T);
		$this->ei08223T=$ei08223T;
		return $this;
	}

	/**
	 * get value for ei_082_23_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08223T() {
		return $this->ei08223T;
	}

	/**
	 * set value for ei_082_24_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08224S
	 * @return Evalinstr
	 */
	public function &setEi08224S($ei08224S) {
		$this->notifyChanged(self::FIELD_EI_082_24_S,$this->ei08224S,$ei08224S);
		$this->ei08224S=$ei08224S;
		return $this;
	}

	/**
	 * get value for ei_082_24_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08224S() {
		return $this->ei08224S;
	}

	/**
	 * set value for ei_082_24_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08224T
	 * @return Evalinstr
	 */
	public function &setEi08224T($ei08224T) {
		$this->notifyChanged(self::FIELD_EI_082_24_T,$this->ei08224T,$ei08224T);
		$this->ei08224T=$ei08224T;
		return $this;
	}

	/**
	 * get value for ei_082_24_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08224T() {
		return $this->ei08224T;
	}

	/**
	 * set value for ei_082_25_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08225S
	 * @return Evalinstr
	 */
	public function &setEi08225S($ei08225S) {
		$this->notifyChanged(self::FIELD_EI_082_25_S,$this->ei08225S,$ei08225S);
		$this->ei08225S=$ei08225S;
		return $this;
	}

	/**
	 * get value for ei_082_25_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08225S() {
		return $this->ei08225S;
	}

	/**
	 * set value for ei_082_25_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08225T
	 * @return Evalinstr
	 */
	public function &setEi08225T($ei08225T) {
		$this->notifyChanged(self::FIELD_EI_082_25_T,$this->ei08225T,$ei08225T);
		$this->ei08225T=$ei08225T;
		return $this;
	}

	/**
	 * get value for ei_082_25_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08225T() {
		return $this->ei08225T;
	}

	/**
	 * set value for ei_082_26_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08226S
	 * @return Evalinstr
	 */
	public function &setEi08226S($ei08226S) {
		$this->notifyChanged(self::FIELD_EI_082_26_S,$this->ei08226S,$ei08226S);
		$this->ei08226S=$ei08226S;
		return $this;
	}

	/**
	 * get value for ei_082_26_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08226S() {
		return $this->ei08226S;
	}

	/**
	 * set value for ei_082_26_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08226T
	 * @return Evalinstr
	 */
	public function &setEi08226T($ei08226T) {
		$this->notifyChanged(self::FIELD_EI_082_26_T,$this->ei08226T,$ei08226T);
		$this->ei08226T=$ei08226T;
		return $this;
	}

	/**
	 * get value for ei_082_26_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08226T() {
		return $this->ei08226T;
	}

	/**
	 * set value for ei_082_27_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $ei08227S
	 * @return Evalinstr
	 */
	public function &setEi08227S($ei08227S) {
		$this->notifyChanged(self::FIELD_EI_082_27_S,$this->ei08227S,$ei08227S);
		$this->ei08227S=$ei08227S;
		return $this;
	}

	/**
	 * get value for ei_082_27_s 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEi08227S() {
		return $this->ei08227S;
	}

	/**
	 * set value for ei_082_27_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $ei08227T
	 * @return Evalinstr
	 */
	public function &setEi08227T($ei08227T) {
		$this->notifyChanged(self::FIELD_EI_082_27_T,$this->ei08227T,$ei08227T);
		$this->ei08227T=$ei08227T;
		return $this;
	}

	/**
	 * get value for ei_082_27_t 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getEi08227T() {
		return $this->ei08227T;
	}

	/**
	 * set value for ei_09_01_t 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @param mixed $ei0901T
	 * @return Evalinstr
	 */
	public function &setEi0901T($ei0901T) {
		$this->notifyChanged(self::FIELD_EI_09_01_T,$this->ei0901T,$ei0901T);
		$this->ei0901T=$ei0901T;
		return $this;
	}

	/**
	 * get value for ei_09_01_t 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @return mixed
	 */
	public function getEi0901T() {
		return $this->ei0901T;
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
			self::FIELD_EI_ID=>$this->getEiId(),
			self::FIELD_EI_DATUM=>$this->getEiDatum(),
			self::FIELD_EI_01_01_S=>$this->getEi0101S(),
			self::FIELD_EI_01_01_T=>$this->getEi0101T(),
			self::FIELD_EI_01_02_S=>$this->getEi0102S(),
			self::FIELD_EI_01_02_T=>$this->getEi0102T(),
			self::FIELD_EI_01_03_S=>$this->getEi0103S(),
			self::FIELD_EI_01_03_T=>$this->getEi0103T(),
			self::FIELD_EI_01_04_S=>$this->getEi0104S(),
			self::FIELD_EI_01_04_T=>$this->getEi0104T(),
			self::FIELD_EI_01_05_S=>$this->getEi0105S(),
			self::FIELD_EI_01_05_T=>$this->getEi0105T(),
			self::FIELD_EI_01_06_S=>$this->getEi0106S(),
			self::FIELD_EI_01_06_T=>$this->getEi0106T(),
			self::FIELD_EI_01_07_S=>$this->getEi0107S(),
			self::FIELD_EI_01_07_T=>$this->getEi0107T(),
			self::FIELD_EI_02_01_S=>$this->getEi0201S(),
			self::FIELD_EI_02_01_T=>$this->getEi0201T(),
			self::FIELD_EI_02_02_S=>$this->getEi0202S(),
			self::FIELD_EI_02_02_T=>$this->getEi0202T(),
			self::FIELD_EI_02_03_S=>$this->getEi0203S(),
			self::FIELD_EI_02_03_T=>$this->getEi0203T(),
			self::FIELD_EI_02_04_S=>$this->getEi0204S(),
			self::FIELD_EI_02_04_T=>$this->getEi0204T(),
			self::FIELD_EI_02_05_S=>$this->getEi0205S(),
			self::FIELD_EI_02_05_T=>$this->getEi0205T(),
			self::FIELD_EI_02_06_S=>$this->getEi0206S(),
			self::FIELD_EI_02_06_T=>$this->getEi0206T(),
			self::FIELD_EI_02_07_S=>$this->getEi0207S(),
			self::FIELD_EI_02_07_T=>$this->getEi0207T(),
			self::FIELD_EI_02_08_S=>$this->getEi0208S(),
			self::FIELD_EI_02_08_T=>$this->getEi0208T(),
			self::FIELD_EI_02_09_S=>$this->getEi0209S(),
			self::FIELD_EI_02_09_T=>$this->getEi0209T(),
			self::FIELD_EI_031_01_S=>$this->getEi03101S(),
			self::FIELD_EI_031_01_T=>$this->getEi03101T(),
			self::FIELD_EI_031_02_S=>$this->getEi03102S(),
			self::FIELD_EI_031_02_T=>$this->getEi03102T(),
			self::FIELD_EI_031_03_S=>$this->getEi03103S(),
			self::FIELD_EI_031_03_T=>$this->getEi03103T(),
			self::FIELD_EI_031_04_S=>$this->getEi03104S(),
			self::FIELD_EI_031_04_T=>$this->getEi03104T(),
			self::FIELD_EI_031_05_S=>$this->getEi03105S(),
			self::FIELD_EI_031_05_T=>$this->getEi03105T(),
			self::FIELD_EI_031_06_S=>$this->getEi03106S(),
			self::FIELD_EI_031_06_T=>$this->getEi03106T(),
			self::FIELD_EI_031_07_S=>$this->getEi03107S(),
			self::FIELD_EI_031_07_T=>$this->getEi03107T(),
			self::FIELD_EI_031_08_S=>$this->getEi03108S(),
			self::FIELD_EI_031_08_T=>$this->getEi03108T(),
			self::FIELD_EI_032_01_S=>$this->getEi03201S(),
			self::FIELD_EI_032_01_T=>$this->getEi03201T(),
			self::FIELD_EI_032_02_S=>$this->getEi03202S(),
			self::FIELD_EI_032_02_T=>$this->getEi03202T(),
			self::FIELD_EI_032_03_S=>$this->getEi03203S(),
			self::FIELD_EI_032_03_T=>$this->getEi03203T(),
			self::FIELD_EI_032_04_S=>$this->getEi03204S(),
			self::FIELD_EI_032_04_T=>$this->getEi03204T(),
			self::FIELD_EI_032_05_S=>$this->getEi03205S(),
			self::FIELD_EI_032_05_T=>$this->getEi03205T(),
			self::FIELD_EI_032_06_S=>$this->getEi03206S(),
			self::FIELD_EI_032_06_T=>$this->getEi03206T(),
			self::FIELD_EI_032_07_S=>$this->getEi03207S(),
			self::FIELD_EI_032_07_T=>$this->getEi03207T(),
			self::FIELD_EI_032_08_S=>$this->getEi03208S(),
			self::FIELD_EI_032_08_T=>$this->getEi03208T(),
			self::FIELD_EI_032_09_S=>$this->getEi03209S(),
			self::FIELD_EI_032_09_T=>$this->getEi03209T(),
			self::FIELD_EI_032_10_S=>$this->getEi03210S(),
			self::FIELD_EI_032_10_T=>$this->getEi03210T(),
			self::FIELD_EI_032_11_S=>$this->getEi03211S(),
			self::FIELD_EI_032_11_T=>$this->getEi03211T(),
			self::FIELD_EI_032_12_S=>$this->getEi03212S(),
			self::FIELD_EI_032_12_T=>$this->getEi03212T(),
			self::FIELD_EI_032_13_S=>$this->getEi03213S(),
			self::FIELD_EI_032_13_T=>$this->getEi03213T(),
			self::FIELD_EI_032_14_S=>$this->getEi03214S(),
			self::FIELD_EI_032_14_T=>$this->getEi03214T(),
			self::FIELD_EI_033_01_S=>$this->getEi03301S(),
			self::FIELD_EI_033_01_T=>$this->getEi03301T(),
			self::FIELD_EI_033_02_S=>$this->getEi03302S(),
			self::FIELD_EI_033_02_T=>$this->getEi03302T(),
			self::FIELD_EI_033_03_S=>$this->getEi03303S(),
			self::FIELD_EI_033_03_T=>$this->getEi03303T(),
			self::FIELD_EI_033_04_S=>$this->getEi03304S(),
			self::FIELD_EI_033_04_T=>$this->getEi03304T(),
			self::FIELD_EI_033_05_S=>$this->getEi03305S(),
			self::FIELD_EI_033_05_T=>$this->getEi03305T(),
			self::FIELD_EI_033_06_S=>$this->getEi03306S(),
			self::FIELD_EI_033_06_T=>$this->getEi03306T(),
			self::FIELD_EI_033_07_S=>$this->getEi03307S(),
			self::FIELD_EI_033_07_T=>$this->getEi03307T(),
			self::FIELD_EI_033_08_S=>$this->getEi03308S(),
			self::FIELD_EI_033_08_T=>$this->getEi03308T(),
			self::FIELD_EI_04_01_S=>$this->getEi0401S(),
			self::FIELD_EI_04_01_T=>$this->getEi0401T(),
			self::FIELD_EI_04_02_S=>$this->getEi0402S(),
			self::FIELD_EI_04_02_T=>$this->getEi0402T(),
			self::FIELD_EI_04_03_S=>$this->getEi0403S(),
			self::FIELD_EI_04_03_T=>$this->getEi0403T(),
			self::FIELD_EI_04_04_S=>$this->getEi0404S(),
			self::FIELD_EI_04_04_T=>$this->getEi0404T(),
			self::FIELD_EI_04_05_S=>$this->getEi0405S(),
			self::FIELD_EI_04_05_T=>$this->getEi0405T(),
			self::FIELD_EI_04_06_S=>$this->getEi0406S(),
			self::FIELD_EI_04_06_T=>$this->getEi0406T(),
			self::FIELD_EI_04_07_S=>$this->getEi0407S(),
			self::FIELD_EI_04_07_T=>$this->getEi0407T(),
			self::FIELD_EI_04_08_S=>$this->getEi0408S(),
			self::FIELD_EI_04_08_T=>$this->getEi0408T(),
			self::FIELD_EI_04_09_S=>$this->getEi0409S(),
			self::FIELD_EI_04_09_T=>$this->getEi0409T(),
			self::FIELD_EI_04_10_S=>$this->getEi0410S(),
			self::FIELD_EI_04_10_T=>$this->getEi0410T(),
			self::FIELD_EI_04_11_S=>$this->getEi0411S(),
			self::FIELD_EI_04_11_T=>$this->getEi0411T(),
			self::FIELD_EI_04_12_S=>$this->getEi0412S(),
			self::FIELD_EI_04_12_T=>$this->getEi0412T(),
			self::FIELD_EI_04_13_S=>$this->getEi0413S(),
			self::FIELD_EI_04_13_T=>$this->getEi0413T(),
			self::FIELD_EI_04_14_S=>$this->getEi0414S(),
			self::FIELD_EI_04_14_T=>$this->getEi0414T(),
			self::FIELD_EI_05_01_S=>$this->getEi0501S(),
			self::FIELD_EI_05_01_T=>$this->getEi0501T(),
			self::FIELD_EI_05_02_S=>$this->getEi0502S(),
			self::FIELD_EI_05_02_T=>$this->getEi0502T(),
			self::FIELD_EI_05_03_S=>$this->getEi0503S(),
			self::FIELD_EI_05_03_T=>$this->getEi0503T(),
			self::FIELD_EI_05_04_S=>$this->getEi0504S(),
			self::FIELD_EI_05_04_T=>$this->getEi0504T(),
			self::FIELD_EI_05_05_S=>$this->getEi0505S(),
			self::FIELD_EI_05_05_T=>$this->getEi0505T(),
			self::FIELD_EI_05_06_S=>$this->getEi0506S(),
			self::FIELD_EI_05_06_T=>$this->getEi0506T(),
			self::FIELD_EI_05_07_S=>$this->getEi0507S(),
			self::FIELD_EI_05_07_T=>$this->getEi0507T(),
			self::FIELD_EI_05_08_S=>$this->getEi0508S(),
			self::FIELD_EI_05_08_T=>$this->getEi0508T(),
			self::FIELD_EI_05_09_S=>$this->getEi0509S(),
			self::FIELD_EI_05_09_T=>$this->getEi0509T(),
			self::FIELD_EI_05_10_S=>$this->getEi0510S(),
			self::FIELD_EI_05_10_T=>$this->getEi0510T(),
			self::FIELD_EI_05_11_S=>$this->getEi0511S(),
			self::FIELD_EI_05_11_T=>$this->getEi0511T(),
			self::FIELD_EI_05_12_S=>$this->getEi0512S(),
			self::FIELD_EI_05_12_T=>$this->getEi0512T(),
			self::FIELD_EI_05_13_S=>$this->getEi0513S(),
			self::FIELD_EI_05_13_T=>$this->getEi0513T(),
			self::FIELD_EI_05_14_S=>$this->getEi0514S(),
			self::FIELD_EI_05_14_T=>$this->getEi0514T(),
			self::FIELD_EI_06_01_S=>$this->getEi0601S(),
			self::FIELD_EI_06_01_T=>$this->getEi0601T(),
			self::FIELD_EI_06_02_S=>$this->getEi0602S(),
			self::FIELD_EI_06_02_T=>$this->getEi0602T(),
			self::FIELD_EI_06_03_S=>$this->getEi0603S(),
			self::FIELD_EI_06_03_T=>$this->getEi0603T(),
			self::FIELD_EI_06_04_S=>$this->getEi0604S(),
			self::FIELD_EI_06_04_T=>$this->getEi0604T(),
			self::FIELD_EI_06_05_S=>$this->getEi0605S(),
			self::FIELD_EI_06_05_T=>$this->getEi0605T(),
			self::FIELD_EI_06_06_S=>$this->getEi0606S(),
			self::FIELD_EI_06_06_T=>$this->getEi0606T(),
			self::FIELD_EI_06_07_S=>$this->getEi0607S(),
			self::FIELD_EI_06_07_T=>$this->getEi0607T(),
			self::FIELD_EI_06_08_S=>$this->getEi0608S(),
			self::FIELD_EI_06_08_T=>$this->getEi0608T(),
			self::FIELD_EI_06_09_S=>$this->getEi0609S(),
			self::FIELD_EI_06_09_T=>$this->getEi0609T(),
			self::FIELD_EI_06_10_S=>$this->getEi0610S(),
			self::FIELD_EI_06_10_T=>$this->getEi0610T(),
			self::FIELD_EI_06_11_S=>$this->getEi0611S(),
			self::FIELD_EI_06_11_T=>$this->getEi0611T(),
			self::FIELD_EI_07_01_S=>$this->getEi0701S(),
			self::FIELD_EI_07_01_T=>$this->getEi0701T(),
			self::FIELD_EI_07_02_S=>$this->getEi0702S(),
			self::FIELD_EI_07_02_T=>$this->getEi0702T(),
			self::FIELD_EI_07_03_S=>$this->getEi0703S(),
			self::FIELD_EI_07_03_T=>$this->getEi0703T(),
			self::FIELD_EI_07_04_S=>$this->getEi0704S(),
			self::FIELD_EI_07_04_T=>$this->getEi0704T(),
			self::FIELD_EI_07_05_S=>$this->getEi0705S(),
			self::FIELD_EI_07_05_T=>$this->getEi0705T(),
			self::FIELD_EI_07_06_S=>$this->getEi0706S(),
			self::FIELD_EI_07_06_T=>$this->getEi0706T(),
			self::FIELD_EI_07_07_S=>$this->getEi0707S(),
			self::FIELD_EI_07_07_T=>$this->getEi0707T(),
			self::FIELD_EI_07_08_S=>$this->getEi0708S(),
			self::FIELD_EI_07_08_T=>$this->getEi0708T(),
			self::FIELD_EI_081_01_S=>$this->getEi08101S(),
			self::FIELD_EI_081_01_T=>$this->getEi08101T(),
			self::FIELD_EI_081_02_S=>$this->getEi08102S(),
			self::FIELD_EI_081_02_T=>$this->getEi08102T(),
			self::FIELD_EI_081_03_S=>$this->getEi08103S(),
			self::FIELD_EI_081_03_T=>$this->getEi08103T(),
			self::FIELD_EI_081_04_S=>$this->getEi08104S(),
			self::FIELD_EI_081_04_T=>$this->getEi08104T(),
			self::FIELD_EI_081_05_S=>$this->getEi08105S(),
			self::FIELD_EI_081_05_T=>$this->getEi08105T(),
			self::FIELD_EI_081_06_S=>$this->getEi08106S(),
			self::FIELD_EI_081_06_T=>$this->getEi08106T(),
			self::FIELD_EI_081_07_S=>$this->getEi08107S(),
			self::FIELD_EI_081_07_T=>$this->getEi08107T(),
			self::FIELD_EI_081_08_S=>$this->getEi08108S(),
			self::FIELD_EI_081_08_T=>$this->getEi08108T(),
			self::FIELD_EI_081_09_S=>$this->getEi08109S(),
			self::FIELD_EI_081_09_T=>$this->getEi08109T(),
			self::FIELD_EI_081_10_S=>$this->getEi08110S(),
			self::FIELD_EI_081_10_T=>$this->getEi08110T(),
			self::FIELD_EI_081_11_S=>$this->getEi08111S(),
			self::FIELD_EI_081_11_T=>$this->getEi08111T(),
			self::FIELD_EI_081_12_S=>$this->getEi08112S(),
			self::FIELD_EI_081_12_T=>$this->getEi08112T(),
			self::FIELD_EI_081_13_S=>$this->getEi08113S(),
			self::FIELD_EI_081_13_T=>$this->getEi08113T(),
			self::FIELD_EI_081_14_S=>$this->getEi08114S(),
			self::FIELD_EI_081_14_T=>$this->getEi08114T(),
			self::FIELD_EI_081_15_S=>$this->getEi08115S(),
			self::FIELD_EI_081_15_T=>$this->getEi08115T(),
			self::FIELD_EI_081_16_S=>$this->getEi08116S(),
			self::FIELD_EI_081_16_T=>$this->getEi08116T(),
			self::FIELD_EI_081_17_S=>$this->getEi08117S(),
			self::FIELD_EI_081_17_T=>$this->getEi08117T(),
			self::FIELD_EI_081_18_S=>$this->getEi08118S(),
			self::FIELD_EI_081_18_T=>$this->getEi08118T(),
			self::FIELD_EI_081_19_S=>$this->getEi08119S(),
			self::FIELD_EI_081_19_T=>$this->getEi08119T(),
			self::FIELD_EI_082_01_S=>$this->getEi08201S(),
			self::FIELD_EI_082_01_T=>$this->getEi08201T(),
			self::FIELD_EI_082_02_S=>$this->getEi08202S(),
			self::FIELD_EI_082_02_T=>$this->getEi08202T(),
			self::FIELD_EI_082_03_S=>$this->getEi08203S(),
			self::FIELD_EI_082_03_T=>$this->getEi08203T(),
			self::FIELD_EI_082_04_S=>$this->getEi08204S(),
			self::FIELD_EI_082_04_T=>$this->getEi08204T(),
			self::FIELD_EI_082_05_S=>$this->getEi08205S(),
			self::FIELD_EI_082_05_T=>$this->getEi08205T(),
			self::FIELD_EI_082_06_S=>$this->getEi08206S(),
			self::FIELD_EI_082_06_T=>$this->getEi08206T(),
			self::FIELD_EI_082_07_S=>$this->getEi08207S(),
			self::FIELD_EI_082_07_T=>$this->getEi08207T(),
			self::FIELD_EI_082_08_S=>$this->getEi08208S(),
			self::FIELD_EI_082_08_T=>$this->getEi08208T(),
			self::FIELD_EI_082_09_S=>$this->getEi08209S(),
			self::FIELD_EI_082_09_T=>$this->getEi08209T(),
			self::FIELD_EI_082_10_S=>$this->getEi08210S(),
			self::FIELD_EI_082_10_T=>$this->getEi08210T(),
			self::FIELD_EI_082_11_S=>$this->getEi08211S(),
			self::FIELD_EI_082_11_T=>$this->getEi08211T(),
			self::FIELD_EI_082_12_S=>$this->getEi08212S(),
			self::FIELD_EI_082_12_T=>$this->getEi08212T(),
			self::FIELD_EI_082_13_S=>$this->getEi08213S(),
			self::FIELD_EI_082_13_T=>$this->getEi08213T(),
			self::FIELD_EI_082_14_S=>$this->getEi08214S(),
			self::FIELD_EI_082_14_T=>$this->getEi08214T(),
			self::FIELD_EI_082_15_S=>$this->getEi08215S(),
			self::FIELD_EI_082_15_T=>$this->getEi08215T(),
			self::FIELD_EI_082_16_S=>$this->getEi08216S(),
			self::FIELD_EI_082_16_T=>$this->getEi08216T(),
			self::FIELD_EI_082_17_S=>$this->getEi08217S(),
			self::FIELD_EI_082_17_T=>$this->getEi08217T(),
			self::FIELD_EI_082_18_S=>$this->getEi08218S(),
			self::FIELD_EI_082_18_T=>$this->getEi08218T(),
			self::FIELD_EI_082_19_S=>$this->getEi08219S(),
			self::FIELD_EI_082_19_T=>$this->getEi08219T(),
			self::FIELD_EI_082_20_S=>$this->getEi08220S(),
			self::FIELD_EI_082_20_T=>$this->getEi08220T(),
			self::FIELD_EI_082_21_S=>$this->getEi08221S(),
			self::FIELD_EI_082_21_T=>$this->getEi08221T(),
			self::FIELD_EI_082_22_S=>$this->getEi08222S(),
			self::FIELD_EI_082_22_T=>$this->getEi08222T(),
			self::FIELD_EI_082_23_S=>$this->getEi08223S(),
			self::FIELD_EI_082_23_T=>$this->getEi08223T(),
			self::FIELD_EI_082_24_S=>$this->getEi08224S(),
			self::FIELD_EI_082_24_T=>$this->getEi08224T(),
			self::FIELD_EI_082_25_S=>$this->getEi08225S(),
			self::FIELD_EI_082_25_T=>$this->getEi08225T(),
			self::FIELD_EI_082_26_S=>$this->getEi08226S(),
			self::FIELD_EI_082_26_T=>$this->getEi08226T(),
			self::FIELD_EI_082_27_S=>$this->getEi08227S(),
			self::FIELD_EI_082_27_T=>$this->getEi08227T(),
			self::FIELD_EI_09_01_T=>$this->getEi0901T());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_EI_ID=>$this->getEiId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Evalinstr instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Evalinstr $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Evalinstr[]
	 */
	public static function findByExample(PDO $db,Evalinstr $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Evalinstr instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Evalinstr[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `evalinstr`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Evalinstr instances
	 *
	 * @param PDOStatement $stmt
	 * @return Evalinstr[]
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
	 * returns the result as an array of Evalinstr instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Evalinstr[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Evalinstr();
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
	 * Execute select query and return matched rows as an array of Evalinstr instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Evalinstr[]
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
		$sql='DELETE FROM `evalinstr`'
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
		$this->setEiId($result['ei_id']);
		$this->setEiDatum($result['ei_datum']);
		$this->setEi0101S($result['ei_01_01_s']);
		$this->setEi0101T($result['ei_01_01_t']);
		$this->setEi0102S($result['ei_01_02_s']);
		$this->setEi0102T($result['ei_01_02_t']);
		$this->setEi0103S($result['ei_01_03_s']);
		$this->setEi0103T($result['ei_01_03_t']);
		$this->setEi0104S($result['ei_01_04_s']);
		$this->setEi0104T($result['ei_01_04_t']);
		$this->setEi0105S($result['ei_01_05_s']);
		$this->setEi0105T($result['ei_01_05_t']);
		$this->setEi0106S($result['ei_01_06_s']);
		$this->setEi0106T($result['ei_01_06_t']);
		$this->setEi0107S($result['ei_01_07_s']);
		$this->setEi0107T($result['ei_01_07_t']);
		$this->setEi0201S($result['ei_02_01_s']);
		$this->setEi0201T($result['ei_02_01_t']);
		$this->setEi0202S($result['ei_02_02_s']);
		$this->setEi0202T($result['ei_02_02_t']);
		$this->setEi0203S($result['ei_02_03_s']);
		$this->setEi0203T($result['ei_02_03_t']);
		$this->setEi0204S($result['ei_02_04_s']);
		$this->setEi0204T($result['ei_02_04_t']);
		$this->setEi0205S($result['ei_02_05_s']);
		$this->setEi0205T($result['ei_02_05_t']);
		$this->setEi0206S($result['ei_02_06_s']);
		$this->setEi0206T($result['ei_02_06_t']);
		$this->setEi0207S($result['ei_02_07_s']);
		$this->setEi0207T($result['ei_02_07_t']);
		$this->setEi0208S($result['ei_02_08_s']);
		$this->setEi0208T($result['ei_02_08_t']);
		$this->setEi0209S($result['ei_02_09_s']);
		$this->setEi0209T($result['ei_02_09_t']);
		$this->setEi03101S($result['ei_031_01_s']);
		$this->setEi03101T($result['ei_031_01_t']);
		$this->setEi03102S($result['ei_031_02_s']);
		$this->setEi03102T($result['ei_031_02_t']);
		$this->setEi03103S($result['ei_031_03_s']);
		$this->setEi03103T($result['ei_031_03_t']);
		$this->setEi03104S($result['ei_031_04_s']);
		$this->setEi03104T($result['ei_031_04_t']);
		$this->setEi03105S($result['ei_031_05_s']);
		$this->setEi03105T($result['ei_031_05_t']);
		$this->setEi03106S($result['ei_031_06_s']);
		$this->setEi03106T($result['ei_031_06_t']);
		$this->setEi03107S($result['ei_031_07_s']);
		$this->setEi03107T($result['ei_031_07_t']);
		$this->setEi03108S($result['ei_031_08_s']);
		$this->setEi03108T($result['ei_031_08_t']);
		$this->setEi03201S($result['ei_032_01_s']);
		$this->setEi03201T($result['ei_032_01_t']);
		$this->setEi03202S($result['ei_032_02_s']);
		$this->setEi03202T($result['ei_032_02_t']);
		$this->setEi03203S($result['ei_032_03_s']);
		$this->setEi03203T($result['ei_032_03_t']);
		$this->setEi03204S($result['ei_032_04_s']);
		$this->setEi03204T($result['ei_032_04_t']);
		$this->setEi03205S($result['ei_032_05_s']);
		$this->setEi03205T($result['ei_032_05_t']);
		$this->setEi03206S($result['ei_032_06_s']);
		$this->setEi03206T($result['ei_032_06_t']);
		$this->setEi03207S($result['ei_032_07_s']);
		$this->setEi03207T($result['ei_032_07_t']);
		$this->setEi03208S($result['ei_032_08_s']);
		$this->setEi03208T($result['ei_032_08_t']);
		$this->setEi03209S($result['ei_032_09_s']);
		$this->setEi03209T($result['ei_032_09_t']);
		$this->setEi03210S($result['ei_032_10_s']);
		$this->setEi03210T($result['ei_032_10_t']);
		$this->setEi03211S($result['ei_032_11_s']);
		$this->setEi03211T($result['ei_032_11_t']);
		$this->setEi03212S($result['ei_032_12_s']);
		$this->setEi03212T($result['ei_032_12_t']);
		$this->setEi03213S($result['ei_032_13_s']);
		$this->setEi03213T($result['ei_032_13_t']);
		$this->setEi03214S($result['ei_032_14_s']);
		$this->setEi03214T($result['ei_032_14_t']);
		$this->setEi03301S($result['ei_033_01_s']);
		$this->setEi03301T($result['ei_033_01_t']);
		$this->setEi03302S($result['ei_033_02_s']);
		$this->setEi03302T($result['ei_033_02_t']);
		$this->setEi03303S($result['ei_033_03_s']);
		$this->setEi03303T($result['ei_033_03_t']);
		$this->setEi03304S($result['ei_033_04_s']);
		$this->setEi03304T($result['ei_033_04_t']);
		$this->setEi03305S($result['ei_033_05_s']);
		$this->setEi03305T($result['ei_033_05_t']);
		$this->setEi03306S($result['ei_033_06_s']);
		$this->setEi03306T($result['ei_033_06_t']);
		$this->setEi03307S($result['ei_033_07_s']);
		$this->setEi03307T($result['ei_033_07_t']);
		$this->setEi03308S($result['ei_033_08_s']);
		$this->setEi03308T($result['ei_033_08_t']);
		$this->setEi0401S($result['ei_04_01_s']);
		$this->setEi0401T($result['ei_04_01_t']);
		$this->setEi0402S($result['ei_04_02_s']);
		$this->setEi0402T($result['ei_04_02_t']);
		$this->setEi0403S($result['ei_04_03_s']);
		$this->setEi0403T($result['ei_04_03_t']);
		$this->setEi0404S($result['ei_04_04_s']);
		$this->setEi0404T($result['ei_04_04_t']);
		$this->setEi0405S($result['ei_04_05_s']);
		$this->setEi0405T($result['ei_04_05_t']);
		$this->setEi0406S($result['ei_04_06_s']);
		$this->setEi0406T($result['ei_04_06_t']);
		$this->setEi0407S($result['ei_04_07_s']);
		$this->setEi0407T($result['ei_04_07_t']);
		$this->setEi0408S($result['ei_04_08_s']);
		$this->setEi0408T($result['ei_04_08_t']);
		$this->setEi0409S($result['ei_04_09_s']);
		$this->setEi0409T($result['ei_04_09_t']);
		$this->setEi0410S($result['ei_04_10_s']);
		$this->setEi0410T($result['ei_04_10_t']);
		$this->setEi0411S($result['ei_04_11_s']);
		$this->setEi0411T($result['ei_04_11_t']);
		$this->setEi0412S($result['ei_04_12_s']);
		$this->setEi0412T($result['ei_04_12_t']);
		$this->setEi0413S($result['ei_04_13_s']);
		$this->setEi0413T($result['ei_04_13_t']);
		$this->setEi0414S($result['ei_04_14_s']);
		$this->setEi0414T($result['ei_04_14_t']);
		$this->setEi0501S($result['ei_05_01_s']);
		$this->setEi0501T($result['ei_05_01_t']);
		$this->setEi0502S($result['ei_05_02_s']);
		$this->setEi0502T($result['ei_05_02_t']);
		$this->setEi0503S($result['ei_05_03_s']);
		$this->setEi0503T($result['ei_05_03_t']);
		$this->setEi0504S($result['ei_05_04_s']);
		$this->setEi0504T($result['ei_05_04_t']);
		$this->setEi0505S($result['ei_05_05_s']);
		$this->setEi0505T($result['ei_05_05_t']);
		$this->setEi0506S($result['ei_05_06_s']);
		$this->setEi0506T($result['ei_05_06_t']);
		$this->setEi0507S($result['ei_05_07_s']);
		$this->setEi0507T($result['ei_05_07_t']);
		$this->setEi0508S($result['ei_05_08_s']);
		$this->setEi0508T($result['ei_05_08_t']);
		$this->setEi0509S($result['ei_05_09_s']);
		$this->setEi0509T($result['ei_05_09_t']);
		$this->setEi0510S($result['ei_05_10_s']);
		$this->setEi0510T($result['ei_05_10_t']);
		$this->setEi0511S($result['ei_05_11_s']);
		$this->setEi0511T($result['ei_05_11_t']);
		$this->setEi0512S($result['ei_05_12_s']);
		$this->setEi0512T($result['ei_05_12_t']);
		$this->setEi0513S($result['ei_05_13_s']);
		$this->setEi0513T($result['ei_05_13_t']);
		$this->setEi0514S($result['ei_05_14_s']);
		$this->setEi0514T($result['ei_05_14_t']);
		$this->setEi0601S($result['ei_06_01_s']);
		$this->setEi0601T($result['ei_06_01_t']);
		$this->setEi0602S($result['ei_06_02_s']);
		$this->setEi0602T($result['ei_06_02_t']);
		$this->setEi0603S($result['ei_06_03_s']);
		$this->setEi0603T($result['ei_06_03_t']);
		$this->setEi0604S($result['ei_06_04_s']);
		$this->setEi0604T($result['ei_06_04_t']);
		$this->setEi0605S($result['ei_06_05_s']);
		$this->setEi0605T($result['ei_06_05_t']);
		$this->setEi0606S($result['ei_06_06_s']);
		$this->setEi0606T($result['ei_06_06_t']);
		$this->setEi0607S($result['ei_06_07_s']);
		$this->setEi0607T($result['ei_06_07_t']);
		$this->setEi0608S($result['ei_06_08_s']);
		$this->setEi0608T($result['ei_06_08_t']);
		$this->setEi0609S($result['ei_06_09_s']);
		$this->setEi0609T($result['ei_06_09_t']);
		$this->setEi0610S($result['ei_06_10_s']);
		$this->setEi0610T($result['ei_06_10_t']);
		$this->setEi0611S($result['ei_06_11_s']);
		$this->setEi0611T($result['ei_06_11_t']);
		$this->setEi0701S($result['ei_07_01_s']);
		$this->setEi0701T($result['ei_07_01_t']);
		$this->setEi0702S($result['ei_07_02_s']);
		$this->setEi0702T($result['ei_07_02_t']);
		$this->setEi0703S($result['ei_07_03_s']);
		$this->setEi0703T($result['ei_07_03_t']);
		$this->setEi0704S($result['ei_07_04_s']);
		$this->setEi0704T($result['ei_07_04_t']);
		$this->setEi0705S($result['ei_07_05_s']);
		$this->setEi0705T($result['ei_07_05_t']);
		$this->setEi0706S($result['ei_07_06_s']);
		$this->setEi0706T($result['ei_07_06_t']);
		$this->setEi0707S($result['ei_07_07_s']);
		$this->setEi0707T($result['ei_07_07_t']);
		$this->setEi0708S($result['ei_07_08_s']);
		$this->setEi0708T($result['ei_07_08_t']);
		$this->setEi08101S($result['ei_081_01_s']);
		$this->setEi08101T($result['ei_081_01_t']);
		$this->setEi08102S($result['ei_081_02_s']);
		$this->setEi08102T($result['ei_081_02_t']);
		$this->setEi08103S($result['ei_081_03_s']);
		$this->setEi08103T($result['ei_081_03_t']);
		$this->setEi08104S($result['ei_081_04_s']);
		$this->setEi08104T($result['ei_081_04_t']);
		$this->setEi08105S($result['ei_081_05_s']);
		$this->setEi08105T($result['ei_081_05_t']);
		$this->setEi08106S($result['ei_081_06_s']);
		$this->setEi08106T($result['ei_081_06_t']);
		$this->setEi08107S($result['ei_081_07_s']);
		$this->setEi08107T($result['ei_081_07_t']);
		$this->setEi08108S($result['ei_081_08_s']);
		$this->setEi08108T($result['ei_081_08_t']);
		$this->setEi08109S($result['ei_081_09_s']);
		$this->setEi08109T($result['ei_081_09_t']);
		$this->setEi08110S($result['ei_081_10_s']);
		$this->setEi08110T($result['ei_081_10_t']);
		$this->setEi08111S($result['ei_081_11_s']);
		$this->setEi08111T($result['ei_081_11_t']);
		$this->setEi08112S($result['ei_081_12_s']);
		$this->setEi08112T($result['ei_081_12_t']);
		$this->setEi08113S($result['ei_081_13_s']);
		$this->setEi08113T($result['ei_081_13_t']);
		$this->setEi08114S($result['ei_081_14_s']);
		$this->setEi08114T($result['ei_081_14_t']);
		$this->setEi08115S($result['ei_081_15_s']);
		$this->setEi08115T($result['ei_081_15_t']);
		$this->setEi08116S($result['ei_081_16_s']);
		$this->setEi08116T($result['ei_081_16_t']);
		$this->setEi08117S($result['ei_081_17_s']);
		$this->setEi08117T($result['ei_081_17_t']);
		$this->setEi08118S($result['ei_081_18_s']);
		$this->setEi08118T($result['ei_081_18_t']);
		$this->setEi08119S($result['ei_081_19_s']);
		$this->setEi08119T($result['ei_081_19_t']);
		$this->setEi08201S($result['ei_082_01_s']);
		$this->setEi08201T($result['ei_082_01_t']);
		$this->setEi08202S($result['ei_082_02_s']);
		$this->setEi08202T($result['ei_082_02_t']);
		$this->setEi08203S($result['ei_082_03_s']);
		$this->setEi08203T($result['ei_082_03_t']);
		$this->setEi08204S($result['ei_082_04_s']);
		$this->setEi08204T($result['ei_082_04_t']);
		$this->setEi08205S($result['ei_082_05_s']);
		$this->setEi08205T($result['ei_082_05_t']);
		$this->setEi08206S($result['ei_082_06_s']);
		$this->setEi08206T($result['ei_082_06_t']);
		$this->setEi08207S($result['ei_082_07_s']);
		$this->setEi08207T($result['ei_082_07_t']);
		$this->setEi08208S($result['ei_082_08_s']);
		$this->setEi08208T($result['ei_082_08_t']);
		$this->setEi08209S($result['ei_082_09_s']);
		$this->setEi08209T($result['ei_082_09_t']);
		$this->setEi08210S($result['ei_082_10_s']);
		$this->setEi08210T($result['ei_082_10_t']);
		$this->setEi08211S($result['ei_082_11_s']);
		$this->setEi08211T($result['ei_082_11_t']);
		$this->setEi08212S($result['ei_082_12_s']);
		$this->setEi08212T($result['ei_082_12_t']);
		$this->setEi08213S($result['ei_082_13_s']);
		$this->setEi08213T($result['ei_082_13_t']);
		$this->setEi08214S($result['ei_082_14_s']);
		$this->setEi08214T($result['ei_082_14_t']);
		$this->setEi08215S($result['ei_082_15_s']);
		$this->setEi08215T($result['ei_082_15_t']);
		$this->setEi08216S($result['ei_082_16_s']);
		$this->setEi08216T($result['ei_082_16_t']);
		$this->setEi08217S($result['ei_082_17_s']);
		$this->setEi08217T($result['ei_082_17_t']);
		$this->setEi08218S($result['ei_082_18_s']);
		$this->setEi08218T($result['ei_082_18_t']);
		$this->setEi08219S($result['ei_082_19_s']);
		$this->setEi08219T($result['ei_082_19_t']);
		$this->setEi08220S($result['ei_082_20_s']);
		$this->setEi08220T($result['ei_082_20_t']);
		$this->setEi08221S($result['ei_082_21_s']);
		$this->setEi08221T($result['ei_082_21_t']);
		$this->setEi08222S($result['ei_082_22_s']);
		$this->setEi08222T($result['ei_082_22_t']);
		$this->setEi08223S($result['ei_082_23_s']);
		$this->setEi08223T($result['ei_082_23_t']);
		$this->setEi08224S($result['ei_082_24_s']);
		$this->setEi08224T($result['ei_082_24_t']);
		$this->setEi08225S($result['ei_082_25_s']);
		$this->setEi08225T($result['ei_082_25_t']);
		$this->setEi08226S($result['ei_082_26_s']);
		$this->setEi08226T($result['ei_082_26_t']);
		$this->setEi08227S($result['ei_082_27_s']);
		$this->setEi08227T($result['ei_082_27_t']);
		$this->setEi0901T($result['ei_09_01_t']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Evalinstr
	 */
	public static function findById(PDO $db,$eiId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$eiId);
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
		$o=new Evalinstr();
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
		$stmt->bindValue(1,$this->getEiId());
		$stmt->bindValue(2,$this->getEiDatum());
		$stmt->bindValue(3,$this->getEi0101S());
		$stmt->bindValue(4,$this->getEi0101T());
		$stmt->bindValue(5,$this->getEi0102S());
		$stmt->bindValue(6,$this->getEi0102T());
		$stmt->bindValue(7,$this->getEi0103S());
		$stmt->bindValue(8,$this->getEi0103T());
		$stmt->bindValue(9,$this->getEi0104S());
		$stmt->bindValue(10,$this->getEi0104T());
		$stmt->bindValue(11,$this->getEi0105S());
		$stmt->bindValue(12,$this->getEi0105T());
		$stmt->bindValue(13,$this->getEi0106S());
		$stmt->bindValue(14,$this->getEi0106T());
		$stmt->bindValue(15,$this->getEi0107S());
		$stmt->bindValue(16,$this->getEi0107T());
		$stmt->bindValue(17,$this->getEi0201S());
		$stmt->bindValue(18,$this->getEi0201T());
		$stmt->bindValue(19,$this->getEi0202S());
		$stmt->bindValue(20,$this->getEi0202T());
		$stmt->bindValue(21,$this->getEi0203S());
		$stmt->bindValue(22,$this->getEi0203T());
		$stmt->bindValue(23,$this->getEi0204S());
		$stmt->bindValue(24,$this->getEi0204T());
		$stmt->bindValue(25,$this->getEi0205S());
		$stmt->bindValue(26,$this->getEi0205T());
		$stmt->bindValue(27,$this->getEi0206S());
		$stmt->bindValue(28,$this->getEi0206T());
		$stmt->bindValue(29,$this->getEi0207S());
		$stmt->bindValue(30,$this->getEi0207T());
		$stmt->bindValue(31,$this->getEi0208S());
		$stmt->bindValue(32,$this->getEi0208T());
		$stmt->bindValue(33,$this->getEi0209S());
		$stmt->bindValue(34,$this->getEi0209T());
		$stmt->bindValue(35,$this->getEi03101S());
		$stmt->bindValue(36,$this->getEi03101T());
		$stmt->bindValue(37,$this->getEi03102S());
		$stmt->bindValue(38,$this->getEi03102T());
		$stmt->bindValue(39,$this->getEi03103S());
		$stmt->bindValue(40,$this->getEi03103T());
		$stmt->bindValue(41,$this->getEi03104S());
		$stmt->bindValue(42,$this->getEi03104T());
		$stmt->bindValue(43,$this->getEi03105S());
		$stmt->bindValue(44,$this->getEi03105T());
		$stmt->bindValue(45,$this->getEi03106S());
		$stmt->bindValue(46,$this->getEi03106T());
		$stmt->bindValue(47,$this->getEi03107S());
		$stmt->bindValue(48,$this->getEi03107T());
		$stmt->bindValue(49,$this->getEi03108S());
		$stmt->bindValue(50,$this->getEi03108T());
		$stmt->bindValue(51,$this->getEi03201S());
		$stmt->bindValue(52,$this->getEi03201T());
		$stmt->bindValue(53,$this->getEi03202S());
		$stmt->bindValue(54,$this->getEi03202T());
		$stmt->bindValue(55,$this->getEi03203S());
		$stmt->bindValue(56,$this->getEi03203T());
		$stmt->bindValue(57,$this->getEi03204S());
		$stmt->bindValue(58,$this->getEi03204T());
		$stmt->bindValue(59,$this->getEi03205S());
		$stmt->bindValue(60,$this->getEi03205T());
		$stmt->bindValue(61,$this->getEi03206S());
		$stmt->bindValue(62,$this->getEi03206T());
		$stmt->bindValue(63,$this->getEi03207S());
		$stmt->bindValue(64,$this->getEi03207T());
		$stmt->bindValue(65,$this->getEi03208S());
		$stmt->bindValue(66,$this->getEi03208T());
		$stmt->bindValue(67,$this->getEi03209S());
		$stmt->bindValue(68,$this->getEi03209T());
		$stmt->bindValue(69,$this->getEi03210S());
		$stmt->bindValue(70,$this->getEi03210T());
		$stmt->bindValue(71,$this->getEi03211S());
		$stmt->bindValue(72,$this->getEi03211T());
		$stmt->bindValue(73,$this->getEi03212S());
		$stmt->bindValue(74,$this->getEi03212T());
		$stmt->bindValue(75,$this->getEi03213S());
		$stmt->bindValue(76,$this->getEi03213T());
		$stmt->bindValue(77,$this->getEi03214S());
		$stmt->bindValue(78,$this->getEi03214T());
		$stmt->bindValue(79,$this->getEi03301S());
		$stmt->bindValue(80,$this->getEi03301T());
		$stmt->bindValue(81,$this->getEi03302S());
		$stmt->bindValue(82,$this->getEi03302T());
		$stmt->bindValue(83,$this->getEi03303S());
		$stmt->bindValue(84,$this->getEi03303T());
		$stmt->bindValue(85,$this->getEi03304S());
		$stmt->bindValue(86,$this->getEi03304T());
		$stmt->bindValue(87,$this->getEi03305S());
		$stmt->bindValue(88,$this->getEi03305T());
		$stmt->bindValue(89,$this->getEi03306S());
		$stmt->bindValue(90,$this->getEi03306T());
		$stmt->bindValue(91,$this->getEi03307S());
		$stmt->bindValue(92,$this->getEi03307T());
		$stmt->bindValue(93,$this->getEi03308S());
		$stmt->bindValue(94,$this->getEi03308T());
		$stmt->bindValue(95,$this->getEi0401S());
		$stmt->bindValue(96,$this->getEi0401T());
		$stmt->bindValue(97,$this->getEi0402S());
		$stmt->bindValue(98,$this->getEi0402T());
		$stmt->bindValue(99,$this->getEi0403S());
		$stmt->bindValue(100,$this->getEi0403T());
		$stmt->bindValue(101,$this->getEi0404S());
		$stmt->bindValue(102,$this->getEi0404T());
		$stmt->bindValue(103,$this->getEi0405S());
		$stmt->bindValue(104,$this->getEi0405T());
		$stmt->bindValue(105,$this->getEi0406S());
		$stmt->bindValue(106,$this->getEi0406T());
		$stmt->bindValue(107,$this->getEi0407S());
		$stmt->bindValue(108,$this->getEi0407T());
		$stmt->bindValue(109,$this->getEi0408S());
		$stmt->bindValue(110,$this->getEi0408T());
		$stmt->bindValue(111,$this->getEi0409S());
		$stmt->bindValue(112,$this->getEi0409T());
		$stmt->bindValue(113,$this->getEi0410S());
		$stmt->bindValue(114,$this->getEi0410T());
		$stmt->bindValue(115,$this->getEi0411S());
		$stmt->bindValue(116,$this->getEi0411T());
		$stmt->bindValue(117,$this->getEi0412S());
		$stmt->bindValue(118,$this->getEi0412T());
		$stmt->bindValue(119,$this->getEi0413S());
		$stmt->bindValue(120,$this->getEi0413T());
		$stmt->bindValue(121,$this->getEi0414S());
		$stmt->bindValue(122,$this->getEi0414T());
		$stmt->bindValue(123,$this->getEi0501S());
		$stmt->bindValue(124,$this->getEi0501T());
		$stmt->bindValue(125,$this->getEi0502S());
		$stmt->bindValue(126,$this->getEi0502T());
		$stmt->bindValue(127,$this->getEi0503S());
		$stmt->bindValue(128,$this->getEi0503T());
		$stmt->bindValue(129,$this->getEi0504S());
		$stmt->bindValue(130,$this->getEi0504T());
		$stmt->bindValue(131,$this->getEi0505S());
		$stmt->bindValue(132,$this->getEi0505T());
		$stmt->bindValue(133,$this->getEi0506S());
		$stmt->bindValue(134,$this->getEi0506T());
		$stmt->bindValue(135,$this->getEi0507S());
		$stmt->bindValue(136,$this->getEi0507T());
		$stmt->bindValue(137,$this->getEi0508S());
		$stmt->bindValue(138,$this->getEi0508T());
		$stmt->bindValue(139,$this->getEi0509S());
		$stmt->bindValue(140,$this->getEi0509T());
		$stmt->bindValue(141,$this->getEi0510S());
		$stmt->bindValue(142,$this->getEi0510T());
		$stmt->bindValue(143,$this->getEi0511S());
		$stmt->bindValue(144,$this->getEi0511T());
		$stmt->bindValue(145,$this->getEi0512S());
		$stmt->bindValue(146,$this->getEi0512T());
		$stmt->bindValue(147,$this->getEi0513S());
		$stmt->bindValue(148,$this->getEi0513T());
		$stmt->bindValue(149,$this->getEi0514S());
		$stmt->bindValue(150,$this->getEi0514T());
		$stmt->bindValue(151,$this->getEi0601S());
		$stmt->bindValue(152,$this->getEi0601T());
		$stmt->bindValue(153,$this->getEi0602S());
		$stmt->bindValue(154,$this->getEi0602T());
		$stmt->bindValue(155,$this->getEi0603S());
		$stmt->bindValue(156,$this->getEi0603T());
		$stmt->bindValue(157,$this->getEi0604S());
		$stmt->bindValue(158,$this->getEi0604T());
		$stmt->bindValue(159,$this->getEi0605S());
		$stmt->bindValue(160,$this->getEi0605T());
		$stmt->bindValue(161,$this->getEi0606S());
		$stmt->bindValue(162,$this->getEi0606T());
		$stmt->bindValue(163,$this->getEi0607S());
		$stmt->bindValue(164,$this->getEi0607T());
		$stmt->bindValue(165,$this->getEi0608S());
		$stmt->bindValue(166,$this->getEi0608T());
		$stmt->bindValue(167,$this->getEi0609S());
		$stmt->bindValue(168,$this->getEi0609T());
		$stmt->bindValue(169,$this->getEi0610S());
		$stmt->bindValue(170,$this->getEi0610T());
		$stmt->bindValue(171,$this->getEi0611S());
		$stmt->bindValue(172,$this->getEi0611T());
		$stmt->bindValue(173,$this->getEi0701S());
		$stmt->bindValue(174,$this->getEi0701T());
		$stmt->bindValue(175,$this->getEi0702S());
		$stmt->bindValue(176,$this->getEi0702T());
		$stmt->bindValue(177,$this->getEi0703S());
		$stmt->bindValue(178,$this->getEi0703T());
		$stmt->bindValue(179,$this->getEi0704S());
		$stmt->bindValue(180,$this->getEi0704T());
		$stmt->bindValue(181,$this->getEi0705S());
		$stmt->bindValue(182,$this->getEi0705T());
		$stmt->bindValue(183,$this->getEi0706S());
		$stmt->bindValue(184,$this->getEi0706T());
		$stmt->bindValue(185,$this->getEi0707S());
		$stmt->bindValue(186,$this->getEi0707T());
		$stmt->bindValue(187,$this->getEi0708S());
		$stmt->bindValue(188,$this->getEi0708T());
		$stmt->bindValue(189,$this->getEi08101S());
		$stmt->bindValue(190,$this->getEi08101T());
		$stmt->bindValue(191,$this->getEi08102S());
		$stmt->bindValue(192,$this->getEi08102T());
		$stmt->bindValue(193,$this->getEi08103S());
		$stmt->bindValue(194,$this->getEi08103T());
		$stmt->bindValue(195,$this->getEi08104S());
		$stmt->bindValue(196,$this->getEi08104T());
		$stmt->bindValue(197,$this->getEi08105S());
		$stmt->bindValue(198,$this->getEi08105T());
		$stmt->bindValue(199,$this->getEi08106S());
		$stmt->bindValue(200,$this->getEi08106T());
		$stmt->bindValue(201,$this->getEi08107S());
		$stmt->bindValue(202,$this->getEi08107T());
		$stmt->bindValue(203,$this->getEi08108S());
		$stmt->bindValue(204,$this->getEi08108T());
		$stmt->bindValue(205,$this->getEi08109S());
		$stmt->bindValue(206,$this->getEi08109T());
		$stmt->bindValue(207,$this->getEi08110S());
		$stmt->bindValue(208,$this->getEi08110T());
		$stmt->bindValue(209,$this->getEi08111S());
		$stmt->bindValue(210,$this->getEi08111T());
		$stmt->bindValue(211,$this->getEi08112S());
		$stmt->bindValue(212,$this->getEi08112T());
		$stmt->bindValue(213,$this->getEi08113S());
		$stmt->bindValue(214,$this->getEi08113T());
		$stmt->bindValue(215,$this->getEi08114S());
		$stmt->bindValue(216,$this->getEi08114T());
		$stmt->bindValue(217,$this->getEi08115S());
		$stmt->bindValue(218,$this->getEi08115T());
		$stmt->bindValue(219,$this->getEi08116S());
		$stmt->bindValue(220,$this->getEi08116T());
		$stmt->bindValue(221,$this->getEi08117S());
		$stmt->bindValue(222,$this->getEi08117T());
		$stmt->bindValue(223,$this->getEi08118S());
		$stmt->bindValue(224,$this->getEi08118T());
		$stmt->bindValue(225,$this->getEi08119S());
		$stmt->bindValue(226,$this->getEi08119T());
		$stmt->bindValue(227,$this->getEi08201S());
		$stmt->bindValue(228,$this->getEi08201T());
		$stmt->bindValue(229,$this->getEi08202S());
		$stmt->bindValue(230,$this->getEi08202T());
		$stmt->bindValue(231,$this->getEi08203S());
		$stmt->bindValue(232,$this->getEi08203T());
		$stmt->bindValue(233,$this->getEi08204S());
		$stmt->bindValue(234,$this->getEi08204T());
		$stmt->bindValue(235,$this->getEi08205S());
		$stmt->bindValue(236,$this->getEi08205T());
		$stmt->bindValue(237,$this->getEi08206S());
		$stmt->bindValue(238,$this->getEi08206T());
		$stmt->bindValue(239,$this->getEi08207S());
		$stmt->bindValue(240,$this->getEi08207T());
		$stmt->bindValue(241,$this->getEi08208S());
		$stmt->bindValue(242,$this->getEi08208T());
		$stmt->bindValue(243,$this->getEi08209S());
		$stmt->bindValue(244,$this->getEi08209T());
		$stmt->bindValue(245,$this->getEi08210S());
		$stmt->bindValue(246,$this->getEi08210T());
		$stmt->bindValue(247,$this->getEi08211S());
		$stmt->bindValue(248,$this->getEi08211T());
		$stmt->bindValue(249,$this->getEi08212S());
		$stmt->bindValue(250,$this->getEi08212T());
		$stmt->bindValue(251,$this->getEi08213S());
		$stmt->bindValue(252,$this->getEi08213T());
		$stmt->bindValue(253,$this->getEi08214S());
		$stmt->bindValue(254,$this->getEi08214T());
		$stmt->bindValue(255,$this->getEi08215S());
		$stmt->bindValue(256,$this->getEi08215T());
		$stmt->bindValue(257,$this->getEi08216S());
		$stmt->bindValue(258,$this->getEi08216T());
		$stmt->bindValue(259,$this->getEi08217S());
		$stmt->bindValue(260,$this->getEi08217T());
		$stmt->bindValue(261,$this->getEi08218S());
		$stmt->bindValue(262,$this->getEi08218T());
		$stmt->bindValue(263,$this->getEi08219S());
		$stmt->bindValue(264,$this->getEi08219T());
		$stmt->bindValue(265,$this->getEi08220S());
		$stmt->bindValue(266,$this->getEi08220T());
		$stmt->bindValue(267,$this->getEi08221S());
		$stmt->bindValue(268,$this->getEi08221T());
		$stmt->bindValue(269,$this->getEi08222S());
		$stmt->bindValue(270,$this->getEi08222T());
		$stmt->bindValue(271,$this->getEi08223S());
		$stmt->bindValue(272,$this->getEi08223T());
		$stmt->bindValue(273,$this->getEi08224S());
		$stmt->bindValue(274,$this->getEi08224T());
		$stmt->bindValue(275,$this->getEi08225S());
		$stmt->bindValue(276,$this->getEi08225T());
		$stmt->bindValue(277,$this->getEi08226S());
		$stmt->bindValue(278,$this->getEi08226T());
		$stmt->bindValue(279,$this->getEi08227S());
		$stmt->bindValue(280,$this->getEi08227T());
		$stmt->bindValue(281,$this->getEi0901T());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getEiId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getEiDatum());
			$stmt->bindValue(2,$this->getEi0101S());
			$stmt->bindValue(3,$this->getEi0101T());
			$stmt->bindValue(4,$this->getEi0102S());
			$stmt->bindValue(5,$this->getEi0102T());
			$stmt->bindValue(6,$this->getEi0103S());
			$stmt->bindValue(7,$this->getEi0103T());
			$stmt->bindValue(8,$this->getEi0104S());
			$stmt->bindValue(9,$this->getEi0104T());
			$stmt->bindValue(10,$this->getEi0105S());
			$stmt->bindValue(11,$this->getEi0105T());
			$stmt->bindValue(12,$this->getEi0106S());
			$stmt->bindValue(13,$this->getEi0106T());
			$stmt->bindValue(14,$this->getEi0107S());
			$stmt->bindValue(15,$this->getEi0107T());
			$stmt->bindValue(16,$this->getEi0201S());
			$stmt->bindValue(17,$this->getEi0201T());
			$stmt->bindValue(18,$this->getEi0202S());
			$stmt->bindValue(19,$this->getEi0202T());
			$stmt->bindValue(20,$this->getEi0203S());
			$stmt->bindValue(21,$this->getEi0203T());
			$stmt->bindValue(22,$this->getEi0204S());
			$stmt->bindValue(23,$this->getEi0204T());
			$stmt->bindValue(24,$this->getEi0205S());
			$stmt->bindValue(25,$this->getEi0205T());
			$stmt->bindValue(26,$this->getEi0206S());
			$stmt->bindValue(27,$this->getEi0206T());
			$stmt->bindValue(28,$this->getEi0207S());
			$stmt->bindValue(29,$this->getEi0207T());
			$stmt->bindValue(30,$this->getEi0208S());
			$stmt->bindValue(31,$this->getEi0208T());
			$stmt->bindValue(32,$this->getEi0209S());
			$stmt->bindValue(33,$this->getEi0209T());
			$stmt->bindValue(34,$this->getEi03101S());
			$stmt->bindValue(35,$this->getEi03101T());
			$stmt->bindValue(36,$this->getEi03102S());
			$stmt->bindValue(37,$this->getEi03102T());
			$stmt->bindValue(38,$this->getEi03103S());
			$stmt->bindValue(39,$this->getEi03103T());
			$stmt->bindValue(40,$this->getEi03104S());
			$stmt->bindValue(41,$this->getEi03104T());
			$stmt->bindValue(42,$this->getEi03105S());
			$stmt->bindValue(43,$this->getEi03105T());
			$stmt->bindValue(44,$this->getEi03106S());
			$stmt->bindValue(45,$this->getEi03106T());
			$stmt->bindValue(46,$this->getEi03107S());
			$stmt->bindValue(47,$this->getEi03107T());
			$stmt->bindValue(48,$this->getEi03108S());
			$stmt->bindValue(49,$this->getEi03108T());
			$stmt->bindValue(50,$this->getEi03201S());
			$stmt->bindValue(51,$this->getEi03201T());
			$stmt->bindValue(52,$this->getEi03202S());
			$stmt->bindValue(53,$this->getEi03202T());
			$stmt->bindValue(54,$this->getEi03203S());
			$stmt->bindValue(55,$this->getEi03203T());
			$stmt->bindValue(56,$this->getEi03204S());
			$stmt->bindValue(57,$this->getEi03204T());
			$stmt->bindValue(58,$this->getEi03205S());
			$stmt->bindValue(59,$this->getEi03205T());
			$stmt->bindValue(60,$this->getEi03206S());
			$stmt->bindValue(61,$this->getEi03206T());
			$stmt->bindValue(62,$this->getEi03207S());
			$stmt->bindValue(63,$this->getEi03207T());
			$stmt->bindValue(64,$this->getEi03208S());
			$stmt->bindValue(65,$this->getEi03208T());
			$stmt->bindValue(66,$this->getEi03209S());
			$stmt->bindValue(67,$this->getEi03209T());
			$stmt->bindValue(68,$this->getEi03210S());
			$stmt->bindValue(69,$this->getEi03210T());
			$stmt->bindValue(70,$this->getEi03211S());
			$stmt->bindValue(71,$this->getEi03211T());
			$stmt->bindValue(72,$this->getEi03212S());
			$stmt->bindValue(73,$this->getEi03212T());
			$stmt->bindValue(74,$this->getEi03213S());
			$stmt->bindValue(75,$this->getEi03213T());
			$stmt->bindValue(76,$this->getEi03214S());
			$stmt->bindValue(77,$this->getEi03214T());
			$stmt->bindValue(78,$this->getEi03301S());
			$stmt->bindValue(79,$this->getEi03301T());
			$stmt->bindValue(80,$this->getEi03302S());
			$stmt->bindValue(81,$this->getEi03302T());
			$stmt->bindValue(82,$this->getEi03303S());
			$stmt->bindValue(83,$this->getEi03303T());
			$stmt->bindValue(84,$this->getEi03304S());
			$stmt->bindValue(85,$this->getEi03304T());
			$stmt->bindValue(86,$this->getEi03305S());
			$stmt->bindValue(87,$this->getEi03305T());
			$stmt->bindValue(88,$this->getEi03306S());
			$stmt->bindValue(89,$this->getEi03306T());
			$stmt->bindValue(90,$this->getEi03307S());
			$stmt->bindValue(91,$this->getEi03307T());
			$stmt->bindValue(92,$this->getEi03308S());
			$stmt->bindValue(93,$this->getEi03308T());
			$stmt->bindValue(94,$this->getEi0401S());
			$stmt->bindValue(95,$this->getEi0401T());
			$stmt->bindValue(96,$this->getEi0402S());
			$stmt->bindValue(97,$this->getEi0402T());
			$stmt->bindValue(98,$this->getEi0403S());
			$stmt->bindValue(99,$this->getEi0403T());
			$stmt->bindValue(100,$this->getEi0404S());
			$stmt->bindValue(101,$this->getEi0404T());
			$stmt->bindValue(102,$this->getEi0405S());
			$stmt->bindValue(103,$this->getEi0405T());
			$stmt->bindValue(104,$this->getEi0406S());
			$stmt->bindValue(105,$this->getEi0406T());
			$stmt->bindValue(106,$this->getEi0407S());
			$stmt->bindValue(107,$this->getEi0407T());
			$stmt->bindValue(108,$this->getEi0408S());
			$stmt->bindValue(109,$this->getEi0408T());
			$stmt->bindValue(110,$this->getEi0409S());
			$stmt->bindValue(111,$this->getEi0409T());
			$stmt->bindValue(112,$this->getEi0410S());
			$stmt->bindValue(113,$this->getEi0410T());
			$stmt->bindValue(114,$this->getEi0411S());
			$stmt->bindValue(115,$this->getEi0411T());
			$stmt->bindValue(116,$this->getEi0412S());
			$stmt->bindValue(117,$this->getEi0412T());
			$stmt->bindValue(118,$this->getEi0413S());
			$stmt->bindValue(119,$this->getEi0413T());
			$stmt->bindValue(120,$this->getEi0414S());
			$stmt->bindValue(121,$this->getEi0414T());
			$stmt->bindValue(122,$this->getEi0501S());
			$stmt->bindValue(123,$this->getEi0501T());
			$stmt->bindValue(124,$this->getEi0502S());
			$stmt->bindValue(125,$this->getEi0502T());
			$stmt->bindValue(126,$this->getEi0503S());
			$stmt->bindValue(127,$this->getEi0503T());
			$stmt->bindValue(128,$this->getEi0504S());
			$stmt->bindValue(129,$this->getEi0504T());
			$stmt->bindValue(130,$this->getEi0505S());
			$stmt->bindValue(131,$this->getEi0505T());
			$stmt->bindValue(132,$this->getEi0506S());
			$stmt->bindValue(133,$this->getEi0506T());
			$stmt->bindValue(134,$this->getEi0507S());
			$stmt->bindValue(135,$this->getEi0507T());
			$stmt->bindValue(136,$this->getEi0508S());
			$stmt->bindValue(137,$this->getEi0508T());
			$stmt->bindValue(138,$this->getEi0509S());
			$stmt->bindValue(139,$this->getEi0509T());
			$stmt->bindValue(140,$this->getEi0510S());
			$stmt->bindValue(141,$this->getEi0510T());
			$stmt->bindValue(142,$this->getEi0511S());
			$stmt->bindValue(143,$this->getEi0511T());
			$stmt->bindValue(144,$this->getEi0512S());
			$stmt->bindValue(145,$this->getEi0512T());
			$stmt->bindValue(146,$this->getEi0513S());
			$stmt->bindValue(147,$this->getEi0513T());
			$stmt->bindValue(148,$this->getEi0514S());
			$stmt->bindValue(149,$this->getEi0514T());
			$stmt->bindValue(150,$this->getEi0601S());
			$stmt->bindValue(151,$this->getEi0601T());
			$stmt->bindValue(152,$this->getEi0602S());
			$stmt->bindValue(153,$this->getEi0602T());
			$stmt->bindValue(154,$this->getEi0603S());
			$stmt->bindValue(155,$this->getEi0603T());
			$stmt->bindValue(156,$this->getEi0604S());
			$stmt->bindValue(157,$this->getEi0604T());
			$stmt->bindValue(158,$this->getEi0605S());
			$stmt->bindValue(159,$this->getEi0605T());
			$stmt->bindValue(160,$this->getEi0606S());
			$stmt->bindValue(161,$this->getEi0606T());
			$stmt->bindValue(162,$this->getEi0607S());
			$stmt->bindValue(163,$this->getEi0607T());
			$stmt->bindValue(164,$this->getEi0608S());
			$stmt->bindValue(165,$this->getEi0608T());
			$stmt->bindValue(166,$this->getEi0609S());
			$stmt->bindValue(167,$this->getEi0609T());
			$stmt->bindValue(168,$this->getEi0610S());
			$stmt->bindValue(169,$this->getEi0610T());
			$stmt->bindValue(170,$this->getEi0611S());
			$stmt->bindValue(171,$this->getEi0611T());
			$stmt->bindValue(172,$this->getEi0701S());
			$stmt->bindValue(173,$this->getEi0701T());
			$stmt->bindValue(174,$this->getEi0702S());
			$stmt->bindValue(175,$this->getEi0702T());
			$stmt->bindValue(176,$this->getEi0703S());
			$stmt->bindValue(177,$this->getEi0703T());
			$stmt->bindValue(178,$this->getEi0704S());
			$stmt->bindValue(179,$this->getEi0704T());
			$stmt->bindValue(180,$this->getEi0705S());
			$stmt->bindValue(181,$this->getEi0705T());
			$stmt->bindValue(182,$this->getEi0706S());
			$stmt->bindValue(183,$this->getEi0706T());
			$stmt->bindValue(184,$this->getEi0707S());
			$stmt->bindValue(185,$this->getEi0707T());
			$stmt->bindValue(186,$this->getEi0708S());
			$stmt->bindValue(187,$this->getEi0708T());
			$stmt->bindValue(188,$this->getEi08101S());
			$stmt->bindValue(189,$this->getEi08101T());
			$stmt->bindValue(190,$this->getEi08102S());
			$stmt->bindValue(191,$this->getEi08102T());
			$stmt->bindValue(192,$this->getEi08103S());
			$stmt->bindValue(193,$this->getEi08103T());
			$stmt->bindValue(194,$this->getEi08104S());
			$stmt->bindValue(195,$this->getEi08104T());
			$stmt->bindValue(196,$this->getEi08105S());
			$stmt->bindValue(197,$this->getEi08105T());
			$stmt->bindValue(198,$this->getEi08106S());
			$stmt->bindValue(199,$this->getEi08106T());
			$stmt->bindValue(200,$this->getEi08107S());
			$stmt->bindValue(201,$this->getEi08107T());
			$stmt->bindValue(202,$this->getEi08108S());
			$stmt->bindValue(203,$this->getEi08108T());
			$stmt->bindValue(204,$this->getEi08109S());
			$stmt->bindValue(205,$this->getEi08109T());
			$stmt->bindValue(206,$this->getEi08110S());
			$stmt->bindValue(207,$this->getEi08110T());
			$stmt->bindValue(208,$this->getEi08111S());
			$stmt->bindValue(209,$this->getEi08111T());
			$stmt->bindValue(210,$this->getEi08112S());
			$stmt->bindValue(211,$this->getEi08112T());
			$stmt->bindValue(212,$this->getEi08113S());
			$stmt->bindValue(213,$this->getEi08113T());
			$stmt->bindValue(214,$this->getEi08114S());
			$stmt->bindValue(215,$this->getEi08114T());
			$stmt->bindValue(216,$this->getEi08115S());
			$stmt->bindValue(217,$this->getEi08115T());
			$stmt->bindValue(218,$this->getEi08116S());
			$stmt->bindValue(219,$this->getEi08116T());
			$stmt->bindValue(220,$this->getEi08117S());
			$stmt->bindValue(221,$this->getEi08117T());
			$stmt->bindValue(222,$this->getEi08118S());
			$stmt->bindValue(223,$this->getEi08118T());
			$stmt->bindValue(224,$this->getEi08119S());
			$stmt->bindValue(225,$this->getEi08119T());
			$stmt->bindValue(226,$this->getEi08201S());
			$stmt->bindValue(227,$this->getEi08201T());
			$stmt->bindValue(228,$this->getEi08202S());
			$stmt->bindValue(229,$this->getEi08202T());
			$stmt->bindValue(230,$this->getEi08203S());
			$stmt->bindValue(231,$this->getEi08203T());
			$stmt->bindValue(232,$this->getEi08204S());
			$stmt->bindValue(233,$this->getEi08204T());
			$stmt->bindValue(234,$this->getEi08205S());
			$stmt->bindValue(235,$this->getEi08205T());
			$stmt->bindValue(236,$this->getEi08206S());
			$stmt->bindValue(237,$this->getEi08206T());
			$stmt->bindValue(238,$this->getEi08207S());
			$stmt->bindValue(239,$this->getEi08207T());
			$stmt->bindValue(240,$this->getEi08208S());
			$stmt->bindValue(241,$this->getEi08208T());
			$stmt->bindValue(242,$this->getEi08209S());
			$stmt->bindValue(243,$this->getEi08209T());
			$stmt->bindValue(244,$this->getEi08210S());
			$stmt->bindValue(245,$this->getEi08210T());
			$stmt->bindValue(246,$this->getEi08211S());
			$stmt->bindValue(247,$this->getEi08211T());
			$stmt->bindValue(248,$this->getEi08212S());
			$stmt->bindValue(249,$this->getEi08212T());
			$stmt->bindValue(250,$this->getEi08213S());
			$stmt->bindValue(251,$this->getEi08213T());
			$stmt->bindValue(252,$this->getEi08214S());
			$stmt->bindValue(253,$this->getEi08214T());
			$stmt->bindValue(254,$this->getEi08215S());
			$stmt->bindValue(255,$this->getEi08215T());
			$stmt->bindValue(256,$this->getEi08216S());
			$stmt->bindValue(257,$this->getEi08216T());
			$stmt->bindValue(258,$this->getEi08217S());
			$stmt->bindValue(259,$this->getEi08217T());
			$stmt->bindValue(260,$this->getEi08218S());
			$stmt->bindValue(261,$this->getEi08218T());
			$stmt->bindValue(262,$this->getEi08219S());
			$stmt->bindValue(263,$this->getEi08219T());
			$stmt->bindValue(264,$this->getEi08220S());
			$stmt->bindValue(265,$this->getEi08220T());
			$stmt->bindValue(266,$this->getEi08221S());
			$stmt->bindValue(267,$this->getEi08221T());
			$stmt->bindValue(268,$this->getEi08222S());
			$stmt->bindValue(269,$this->getEi08222T());
			$stmt->bindValue(270,$this->getEi08223S());
			$stmt->bindValue(271,$this->getEi08223T());
			$stmt->bindValue(272,$this->getEi08224S());
			$stmt->bindValue(273,$this->getEi08224T());
			$stmt->bindValue(274,$this->getEi08225S());
			$stmt->bindValue(275,$this->getEi08225T());
			$stmt->bindValue(276,$this->getEi08226S());
			$stmt->bindValue(277,$this->getEi08226T());
			$stmt->bindValue(278,$this->getEi08227S());
			$stmt->bindValue(279,$this->getEi08227T());
			$stmt->bindValue(280,$this->getEi0901T());
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
			$this->setEiId($lastInsertId);
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
		$stmt->bindValue(282,$this->getEiId());
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
		$stmt->bindValue(1,$this->getEiId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch Overlegbasis's which this Evalinstr references.
	 * `evalinstr`.`ei_id` -> `overlegbasis`.`evalinstr_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public function fetchOverlegbasisCollection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_EVALINSTR_ID=>$this->getEiId());
		return Overlegbasis::findByFilter($db, $filter, true, $sort);
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Evalinstr');
	}

	/**
	 * get single Evalinstr instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Evalinstr
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Evalinstr();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Evalinstr from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Evalinstr[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Evalinstr') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>