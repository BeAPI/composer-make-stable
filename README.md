<a href="https://beapi.fr">![Be API Github Banner](banner-github.png)</a>

# Composer Make Stable

Make all of your composer's dependencies stable.

This command is useful especially during an audit. It allows you to grab latest versions of your requirements.
Once your audit is finished it's recommended to use another command : [Freeze version](https://github.com/BeAPI/composer-freeze-version) to keep versions you have tested.

# What ?

Your dependencies into composer.json will be automatically be changed from :

`"wpackagist-plugin/wordpress-seo":"6.2"`

into :

`"wpackagist-plugin/wordpress-seo":"*@stable"`

![Composer Make Stable : how to)](https://blog.beapi.fr/wp-content/uploads/2018/06/bea-composer-make-stable.gif)

# How ?

## 1 - Add to [Composer](http://composer.rarst.net/)

- Add repository source : `{ "type": "vcs", "url": "https://github.com/BeAPI/composer-make-stable" }`.
- Include `"bea/composer/make-stable": "dev-master"` in your composer file as require-dev.
- Before use, launch `composer update`.

## 2 - Run command
Then you can simply launch `composer make-stable` !

# Who ?

Created by [Be API](https://beapi.fr), the French WordPress leader agency since 2009. Based in Paris, we are more than 30 people and always [hiring](https://beapi.workable.com) some fun and talented guys. So we will be pleased to work with you.

This plugin is only maintained, which means we do not guarantee some free support. If you identify any errors or have an idea for improving this script, feel free to open an [issue](../../issues/new). Please provide as much info as needed in order to help us resolving / approve your request. And .. be patient :)

If you really like what we do or want to thank us for our quick work, feel free to [donate](https://www.paypal.me/BeAPI) as much as you want / can, even 1€ is a great gift for buying cofee :)

## License

Composer Make Stable is licensed under the [GPLv3 or later](LICENSE.md).
