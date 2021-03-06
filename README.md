Gravity PDF Core Booster
==========================

![Core Booster Artwork](https://resources.gravitypdf.com/uploads/edd/2017/06/cover-artwork-shorter-1.png)

[![Build Status](https://travis-ci.org/GravityPDF/gravity-pdf-core-booster.svg?branch=development)](https://travis-ci.org/GravityPDF/gravity-pdf-core-booster)

Gravity PDF Core Booster is a commercial plugin [available from GravityPDF.com](https://gravitypdf.com/shop/core-booster-add-on/). The plugin is hosted here on a public GitHub repository in order to better facilitate community contributions from developers and users. If you have a suggestion, a bug report, or a patch for an issue, feel free to submit it here.

If you are using the plugin on a live site, please purchase a valid license from the website. **We cannot provide support to anyone that does not hold a valid license key**.

# About

This Git repository is for developers who want to contribute to Gravity PDF Core Booster. **Don't use it in production**. For production use, [purchase a license and install the packaged version from our online store](https://gravitypdf.com/shop/core-booster-add-on/).

The `development` branch is considered our bleeding edge branch, with all new changes pushed to it. The `master` branch is our latest stable version of Gravity PDF Core Booster.

# Installation

Before beginning, ensure you have [Git](https://git-scm.com/), [Composer](https://getcomposer.org/) and [Yarn](https://yarnpkg.com/en/docs/install) installed and their commands are globally accessible via the command line.

1. Clone the repository using `git clone https://github.com/GravityPDF/gravity-pdf-core-booster/`
1. Open your terminal / command prompt to the Gravity PDF Core Booster root directory and run `composer install`
1. Copy the plugin to your WordPress plugin directory (if not there already) and active through your WordPress admin area

### Run Unit Tests

#### PHPUnit

We use PHPUnit to test out all the PHP we write. The tests are located in `tests/phpunit/unit-tests/`

Installing the testing environment is best done using a flavour of Vagrant (try [Varying Vagrant Vagrants](https://github.com/Varying-Vagrant-Vagrants/VVV)).

1. From your terminal SSH into your Vagrant box using the `vagrant ssh` command
2. `cd` into the root of your Gravity PDF Core Booster directory
3. Run `bash tests/bin/install.sh gravitypdf_test root root localhost` where `root root` is substituted for your mysql username and password (VVV users can run the command as is).
4. Upon success you can run `vendor/bin/phpunit` and `vendor/bin/phpunit --group ajax`