<?
declare(strict_types = 1);

namespace zPHP\Validate;

class Phone {

	/**
	 * Check number and convert to international format
	 *
	 * @throws Exceptions\PhoneInvalid
	 */
	static function toFormat (string $phone) : string {
		// Cleaning
		$phone = preg_replace('/[^0-9]/', '', $phone);

		// @todo Exception for russian numbers
		$phone = preg_replace('/^8/', '7', $phone);

		$phone = '+' . $phone;

		// Checking number
		if (!preg_match('/^\+([0-9]{1,3})([0-9]{10})$/', $phone))
			throw new Exceptions\PhoneInvalid;

		return $phone;
	}

	/**
	 * @throws Exceptions\PhoneInvalid
	 */
	static function isRus (string $phone) : bool {
		$phone = self::toFormat($phone);
		return (bool)preg_match('/^\+7([0-9]{10,10})$/', $phone);
	}

	/**
	 * Clean phone number
	 *
	 * @todo deprecated
	 * @throws Exceptions\PhoneInvalid
	 */
	static function clean (string $phone) : string {
		$phone = preg_replace('/[^0-9\+]/', '', $phone);
		if (!preg_match('/^(\+)?([0-9]{2,13})$/', $phone))
			throw new Exceptions\PhoneInvalid;
		return $phone;
	}
}