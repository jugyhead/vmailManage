# vmailManage

This project is a fork of https://github.com/Andreas-Bresch/vmailManage.

---

vmailManage aims to provide a decent web UI for Mailsystems based on the [HOWTO by Thomas Leister](https://thomas-leister.de/mailserver-debian-buster/).

While most of Thomas's tutorial is appropriate for this project some changes have to be made.

## Installation

* Clone the repo:
    `git clone https://github.com/jugyhead/vmailManage.git`
* Install PHP 7.1+ and [Composer](https://getcomposer.org/download/)
* Then:


    $ cd vmailManage/
    $ composer install
    $ cp .env .env.local

* Edit `.env.local` to match your database and change `APP_ENV` to `prod`.
* Now set up your virtual host.

## Configuration

### CREATE TABLE statements

...

### Configuration modifications

...

## Using vmailManage

...
