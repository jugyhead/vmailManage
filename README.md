# vmailManage

This project is a fork of https://github.com/Andreas-Bresch/vmailManage which has not been updated since September 2018.

---

vmailManage aims to provide a decent web UI for Mailsystems based on the [HOWTO by Thomas Leister](https://thomas-leister.de/mailserver-debian-buster/).

While most of Thomas's tutorial is appropriate for this project some changes have to be made.

## Installation

Clone the repo:

    $ git clone https://github.com/jugyhead/vmailManage.git

Install PHP 7.1+ and [Composer](https://getcomposer.org/download/)

Then:

    $ cd vmailManage/
    $ composer install
    $ cp .env .env.local

Now generate credentials:

    $ bin/console security:encode-password

* Edit `.env.local` to match your database, change `APP_ENV` to `prod` and enter admin credentials.

* Finally set up your virtual host.

## Configuration

### Database customization

The database schema used by vmailManage differs slightly from the original. For development reasons the project was created using Doctrine ORM and I wanted to stick with that but didn't like the tweaks and work-arounds Andreas had to implement to make it work properly.

#### Fresh database:

If you skipped Thomas Leister's database set-up you may just create the structure with Doctrine:

    $ bin/console doctrine:schema:create

#### Converting an existing schema:

First: **MAKE A BACKUP!**

Then: Now that you have a backup, proceed:


    ALTER TABLE `tlspolicies`
        CHANGE `policy` `policy` VARCHAR(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
    ALTER TABLE `aliases` ADD `source_domain_id` INT UNSIGNED NOT NULL AFTER `source_domain`;
    UPDATE `aliases` A
        INNER JOIN `domains` D ON A.source_domain = D.domain
        SET A.source_domain_id = D.id;
    ALTER TABLE `accounts` ADD `domain_id` INT UNSIGNED NOT NULL AFTER `domain`;
    UPDATE `accounts` A
        INNER JOIN `domains` D ON A.domain = D.domain
        SET A.domain_id = D.id;
    ALTER TABLE vmail.aliases DROP FOREIGN KEY aliases_ibfk_1;
    ALTER TABLE vmail.accounts DROP FOREIGN KEY accounts_ibfk_1;


Finally let Doctrine rebuild the relations:

    $ bin/console doctrine:schema:update --dump-sql
    $ bin/console doctrine:schema:update --force

### Configuration modifications

First: **BACKUP THE ORIGINAL FILES!**

## Using vmailManage

It's pretty much self-explanatory. Need help? Post an issue.

## Translation

See 'How to contribute'.

## How to contribute

Pull requests are always welcome. Implementing tests are very appreciated as well as graphical customization as long as it's based on bootstrap and provides a clean user experience.
