<a href="https://webtigers.com/" target="_blank">
    <img src="https://webtigers.s3.amazonaws.com/assets/img/TigerIntroLogo.jpg" alt="WebTigers Tiger header" title="Tiger" align="center" />
</a>

# A WebTigers LAMP Development Platform

[![License: AGPL v3](https://img.shields.io/badge/License-AGPL%20v3-blue.svg)](https://www.gnu.org/licenses/agpl-3.0) [![License: AGPL v3](https://img.shields.io/badge/License-Commercial-green.svg)](https://www.webtigers.com/license)

## Tiger Quick Links
Quick-launch and setup instructions are at the end of this document.

Tiger Docs can be found here: [Tiger Docs on GoogleDocs](https://docs.google.com/document/d/1eUkRWeliVnJ8bEZa_C_MGaICsoJWMongR1xIE6E-W_s/edit?usp=sharing)

Docs for updated ZendFramework 1: [ZF1-Future Manual](https://webtigers.com/manual)

Launch a new Tiger instance: [Tiger on AWS](https://aws.amazon.com/marketplace/pp/prodview-wixkz63qgutes)

How to get in-touch with WebTigers: [Contact us](mailto:support@webtigers.com)

# Welcome to Tiger

### What does this Tiger thing do?

Tiger is an easy-to-use yet robust enterprise-class application framework already running in the box (server) that almost any web developer can use to instantly:

- Create a Website,
- Publish a Blog,
- Start building a new Web Application,
- Create your next big SaaS app!

Tiger is like WordPress on enterprise-class steroids.

### But there’s nothing to install.

Tiger is a self-contained AWS EC2 server instance for modern enterprise-class PHP applications.
The moment you launch a Tiger instance within your AWS environment, Tiger is fully up and running and ready to go.
We designed Tiger to be able to be used by any level of developer, from beginner to seasoned engineer.

### Tiger just works out of the box.

Assign the Tiger instance a public IP or DNS and you will immediately see the Tiger Welcome screen letting you know that all services are up and running and available.
The beauty of Tiger is its consistency and well-documented features. You do not have to lift a finger, so to speak, to have an easy-to-use, enterprise-class LAMP stack ready to go.

And there’s nothing hidden or obfuscated within the server. Everything is open to you to re-configure, update, upgrade, etc., however you wish.

### Who Should Use Tiger?
- Content Creators
- PHP Developers
- Media Agencies
- SaaS Startups
- Clients who need a self-contained shared or non-shared web server
- People who love the power and ease of a non-opinionated PHP framework

## Cost
The price of a Tiger instance is **just $12 per mo.** plus whatever size AWS instance you have chosen.
### 30-Days Free!
There is no cost to checkout Tiger. Fire up a Tiger instance using the AWS free-tier and have a look around at NO COST.

## Why Do I Need Tiger?
#### Because you don’t have unlimited time and money.
Tiger will save you months of work and hundreds of hours in development time in getting your website, SaaS app, or blog up and running.
Most, if not all, of the core functionality of a typical SaaS application is already built out and done for you.
Why reinvent the wheel each time you or a new client needs a software application platform?
Tiger has these pieces already in place and is ready to rock!

### Cost/Benefit Analysis
WebTigers has already done all the heavy lifting for you in terms of getting your new multi-user website or SaaS app up and running.

It would cost you literally 1,000’s of hours of development time just to get your new site or custom web application to the point where Tiger is out of the box! 

How do we know? Because that is exactly the amount of time we put into building Tiger!

The typical development cost for web apps is $75 to $100 per hour for very experienced developers and application architects.
Tiger has just saved you at a minimum, 3 to 6 months of exceptional work.

If you had only 2 very experienced full-time developers and architects working for 3 months just to get your SaaS app up and running to a base operation of user management, you’d spend $50,000 to $150,000 in people hours alone.

Tiger has you up and running out of the box for **just USD$12.00 a month** per Tiger instance. Tiger saves you huge amounts of time and money. Those are precious months and dollars you can be devoting to marketing and other aspects of your business!

# Specifications
Here’s what makes Tiger tick ...

### Relevant LAMP Technologies
- Amazon Linux 2
- Apache 2.4
- MariaDB 10.5
- PHP 7.4

### Features
- ZendFramework 1
- Composer-controlled PHP libraries
- One-click module updates
- phpMyAdmin pre-installed
- Single-folder server configuration

### Tiger Speed
Tiger is plain PHP code, not compiled. Running on an AWS micro instance Tiger delivers sub-400 ms loading. That's faster than Larvel and Symfony! And on larger instances Tiger is even faster!

### Tiger Security
Tiger undergoes continuous security checks and evaluations with each new release. Our team has implemented numerous enterprise-class security features designed to help protect and harden your application from hackers, such as:

- High-port Admin area access (8080 & 8081 for SSL) that you can shut-off to the outside world.
- PHP files located outside of the public document root (way more secure than WordPress).
- Rigorous penetration scanning to detect common vulnerabilities.
- Code scanning to make sure Tiger’s codebase is secure.
- Immediate logout of suspended accounts.

### Application
- Zend Framework 1 fully updated and modularized to run on PHP 7 or 8.
- Zend Config, both static .ini file and database-driven override configuration.
- Zend ACL, both static .ini file and database-driven override access control.
- Zend Translate, both static file and database-driven localization and translation.
- Tiger Core Module, the core application layer.
- Tiger Account Module, a fully baked user, org (group), profile management module.
- Tiger CMS Module, a fully functional CMS and blogging engine.
- Tiger Media Module, a fully function media management module; store files locally or in S3.
- Tiger Message, an easy-to-use module for internal app messaging.
- Tiger Package, a fully functional package manager to handle package updates in the UI.
- Tiger API, a unique, easy-to-use JSON-RPC implementation for webservices.
- Tiger Cache, memcached already implemented if you need it.
- Tiger Backup, auto backup your Tiger DB to the filesystem or AWS S3.
- Tiger Server, a growing list of features and functions that make running your Tiger server a breeze, like showing current PHPInfo right in the UI.

### UI
- Bootstrap 4
- jQuery (full)
- OneUI™ backend Theme by pixelcave
- Canvas™ frontend Theme by SemiColonWeb
- Front-end Agnostic, use any frontend you like: Vue, Angular, or whatever.

# Tiger Platform

### Why ZendFramework 1?

Out of the gate, new and seasoned developers are going to be asking one question: Why does Tiger use ZF1―the framework has been “abandoned and is no longer supported”, right?

Nope. Actually, Zend abandoned supporting the framework to pursue other versions; but the ZF1 community did not. ZF1 still has an active and thriving community of developers who continue to support and update this exceptional framework with feature enhancements, bug and security fixes.

When Zend abandoned ZF1 it was stuck at version 1.12 and did not work with later versions of PHP greater than 5.6. That is no longer the case. The latest version of ZF1 in use by Tiger is now 1.20, it works in all versions of PHP, including PHP 7.4 and and 8.

ZF1 has had over 100 new commits by the ZF1 Community. ZF1 is far from dead.

### ZendFramework Reborn!

Some of the many reasons we chose ZF1 for the Tiger platform were:

- A non-opinionated architecture,
- Easy autoloading,
- Ease of use,
- Exceptional featureset,
- Enterprise-class architecture for modular, component-driven development.

Just because ZF2 and ZF3 were written, does not mean that ZF1 was inferior. ZF2 itself was plagued by a myriad of architectural flaws, namely its heavy reliance on static config files. And ZF3 has become more or less a me-too of Laravel.

The WebTiger’s proprietary build of ZF1 within the Tiger Platform allows both users and developers a near unlimited amount of depth, control, and architectural latitude over their applications, more than any other framework we’ve worked with.

### Tiger is UI Agnostic
You might notice that we did not install a lot of front-end UI technologies.
This is because at the end of the day, you are the one driving the UI, not Tiger.
If you prefer React, Vue, Tailwind, or an Angular SPA (single-page application) that is up to you. Tiger’s UI can be completely decoupled from the backend. All you make are ajax webservice calls to populate your UI framework data.

## Forking and Cloning
This repo is available for forking and cloning for your Tiger development purposes. However, certain theme modules are not included within this repo and are only available by launching a Tiger Instance. Forking or cloning this repo will not give you a fully operational platform.

Publishing non-public Tiger modules is a violation of owner copyrights and is prohibited.

# Bug Reports
Feel free to post bugs and other issues on [GitHub Issues](https://github.com/WebTigers/Tiger/issues). We will attempt to remedy whatever issues and then post a new release to fix issues quickly. We appreciate your help in ferreting out bugs and anything else that you think might be wonky.

# Security Issues
Please do not post security issues publicly. [Contact us](mailto:support@webtigers.com?subject=TIGER%20Security%20Issue) privately so that we have time to fix whatever issue for the safety and security of our clients.

# License
Tiger is dual-licensed under AGPL 3.0 and Commercial licenses. Basically, you can use Tiger instances to build your own projects much more quickly and distribute those projects while maintaining control of your own code.

See License.txt for details.

# Links
- [WebTigers.com](https://webtigers.com)
- [Tiger Docs on GoogleDocs](https://docs.google.com/document/d/1eUkRWeliVnJ8bEZa_C_MGaICsoJWMongR1xIE6E-W_s/edit?usp=sharing)
- [ZF1-Future](https://github.com/Shardj/zf1-future) — Latest community supported and updated ZendFramework 1
- [ZF1-Future Manual](https://webtigers.com/manual) — Docs for ZendFramework 1

# Roadmap
- **Tiger Tests are coming.** If you would like to help out and write tests for WebTigers, [contact us](mailto:support@webtigers.com) and let us know what your time costs are.
- **Multi-site Management.** You can do multiple sites from a Tiger instance, but you'd need to set these up manually. We want to automate this process.

# Quick Launch / Setup
Launch a Tiger Instance within your AWS environment here: https://aws.amazon.com/marketplace/pp/prodview-wixkz63qgutes

Be sure you assign a Public IP to the Instance.

Once your EC2 server instance is up and running, COPY the server’s InstanceID to your clipboard. This is your initial login password.

Navigate to the Admin area of the box to setup the server:

http://[your.public.ip.address]/admin

You will be taken to the login screen. Login with:
- Username: tiger
- Password: [InstanceID]  (paste from your clipboard)

You will be taken to the Tiger Admin Desktop.

Fill out the Setup Wizard to setup your Tiger Instance.

<br><br>
___

Copyright 2020-2021 WebTigers
