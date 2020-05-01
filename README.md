# Now playing for AzuraCast

Contributors: sirjavik, se-schwarz
Stable tag: 2.0.0
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=truebenny003%40gmail.com&currency_code=EUR&source=url
Tags: AzuraCast, Widget, Radio, Webradio, Icecast, Shoutcast, Playing, Nowplaying
Requires at least: 4.6.0
Tested up to: 5.4
Requires PHP: 5.6.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Display currently played song of an AzuraCast instance in a sidebar.

## Description

This plugin adds a widget to your WordPress sidebar showing the currently played song of a AzuraCast station by their public API. You're able to configure whether to display the album, title, artist, artwork and player links.

## Installation 

1. Upload the plugin files to your WordPress plugins directory, e.g. '/wp-content/plugins/plugins/'.
2. Enable the plugin pressing 'Activate'.
3. Add and configure the widget under 'Appearance' -> 'Widgets'. 

## Changelog 

### 1.2.0
- Data from AzuraCast is now loaded asynchronous. By default the AzuraCast-Widget will be refreshed every 5 minutes. You can change that setting in the widgets settings or can disable this feature completely.
- I'm looking for a way to use AzuraCast's Webhook API. Perhaps new data will be loaded directly in a newer version instead of refreshing it staticly every x minutes.

### 1.1.9
- Fixed not working webplayer button. Spaces are evil.

### 1.1.7 
- Fixed wording
- Fixed translation issues

### 1.1.6
- Default language is English now.
- Improvements for small and mobile sidebars.

### 1.1.4 & 1.1.5
- Fixed several translation issues. Should work all like a charm now.

### 1.1.3
- Fixed a bug that prevented translations from loading 

### 1.1.2
- Added translation template and first strings

### 1.1.1
- Fixed german language

### 1.1.0 
- Fixed a couple of issues.
- Added configuration settings.
- Completed widget appearance.

### 1.0.0 
- Initioal version, rudimentary.
