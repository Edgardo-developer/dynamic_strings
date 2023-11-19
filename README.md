# Dynamic Strings
Our innovative plugin, Dynamic Strings, is the perfect tool for crafting translations in your projects. With easy grouping and individual customization for each word, it simplifies and enhances the translation creation process. Let your content speak in multiple languages effortlessly, making translation creation both straightforward and efficient.

## Install
Download the plugin from the Guthub repository

## Functions
```php
dnn_(string, language)
```
Get the translated string by code of language
```php
dnn_s($original, $language, $translated, $groupName)
```
Update or create new translation of string
```php
dnn_g($groupName, $language, $associative = true)
```
Get the translated strings by the code of language
```php
dnn_r($original, $language)
```
Remove the translation of the string
```php
dnn_langs()
```
Returns all slugs of languages