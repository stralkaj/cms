<?php

declare(strict_types=1);

namespace Baraja\Cms\User\Entity;


use Nette\Security\IIdentity;

interface CmsUser extends IIdentity
{
	public const ROLE_USER = 'user';

	public function __construct(string $username, string $password, string $email, string $role = self::ROLE_USER);

	/**
	 * @return string[]
	 */
	public function getRoles(): array;

	public function isAdmin(): bool;

	public function containPrivilege(string $privilege): bool;

	/**
	 * @return string[]
	 */
	public function getData(): array;

	public function getFirstName(): ?string;

	public function setFirstName(?string $firstName): void;

	public function getLastName(): ?string;

	public function setLastName(?string $lastName): void;

	public function getUsername(): string;

	public function setUsername(string $username): void;

	public function getPassword(): string;

	public function setPassword(string $password): void;

	public function passwordVerify(string $password): bool;

	public function resetRoles(): void;

	public function addRole(string $role): void;

	public function resetPrivileges(): void;

	/**
	 * @return string[]
	 */
	public function getPrivileges(): array;

	public function addPrivilege(string $permission): void;

	/**
	 * Return primary user e-mail.
	 */
	public function getEmail(): string;

	public function setEmail(string $email): void;

	public function addEmail(string $email): void;

	/**
	 * Remove e-mail from user e-mail array. Return true if all was success.
	 *
	 * E-mail can not be removed if the user has none -> return false, because user must have at least one.
	 */
	public function removeEmail(string $email): bool;

	public function getRegisterDate(): \DateTime;

	public function setRegisterDate(\DateTime $registerDate): void;

	public function getCreateDate(): \DateTime;

	public function setCreateDate(\DateTime $createDate): void;

	/**
	 * @return string[]
	 */
	public function getMetaData(): array;

	public function getOtpCode(): ?string;

	public function setOtpCode(?string $otpCode): void;

	public function isActive(): bool;

	public function setActive(bool $active): void;

	public function getAvatarUrl(): ?string;

	public function setAvatarUrl(?string $avatarUrl): void;

	public function getName(bool $reverse = false): string;

	public function getPhone(): ?string;

	public function setPhone(?string $phone, int $region = 420): void;
}
