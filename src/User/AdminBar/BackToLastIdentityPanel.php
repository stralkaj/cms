<?php

declare(strict_types=1);

namespace Baraja\Cms\User\AdminBar;


use Baraja\AdminBar\Panel\Panel;
use Baraja\Cms\LinkGenerator;
use Baraja\Cms\User\UserManager;
use Baraja\Cms\User\UserManagerAccessor;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

final class BackToLastIdentityPanel implements Panel
{
	public function __construct(
		private UserManagerAccessor $userManager,
	) {
	}


	public function getTab(): string
	{
		$userId = $_SESSION[UserManager::LAST_IDENTITY_ID__SESSION_KEY] ?? null;
		if ($userId === null) {
			return '';
		}
		try {
			$user = $this->userManager->get()->getUserById((string) $userId);
		} catch (NoResultException | NonUniqueResultException) {
			return '';
		}

		$url = LinkGenerator::generateInternalLink('User:loginAs', ['id' => $user->getId()]);

		return '<a href="' . $url . '" class="btn btn-primary" style="background:#17a2b8 !important" title="Switch the current login session back to the last user\'s profile.">'
			. 'Back to <b style="color:#000 !important">' . htmlspecialchars($user->getName()) . '</b>'
			. '</a>';
	}


	public function getBody(): ?string
	{
		return null;
	}


	public function getPriority(): ?int
	{
		return 99;
	}
}
