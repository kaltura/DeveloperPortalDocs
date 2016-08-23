---
layout: page
title: Kaltura Video Insights - Dimensions Lexicon
weight: 130
subcat: Limited-Alpha
---

*The below dimensions are part of Kaltura's new analytics platform.*
*It is available by request, as it is currently released as an Early Preview.*
*Please write to maya.schnaidman@kaltura.com to request activation.*

| Group       | Name     | ID     | Description
|:---|:---|:---|:---|
| Basic             | Partner            |  partner | The partner account ID on Kaltura's platform	|
| Basic             | Entry	 |entry	 |The delivered content ID on Kaltura's platform |
| Basic             |Known User	|knownUser|	The Kaltura logged-in user who watched the video|
|User Agent | Device	|device	 |Which device the video was played on. Available values: computer, mobile, tablet, gameConsole, dmr (digital media receiver), wearable, unknown|
|User Agent | Operating System |	operatingSystem	|Which operating system the video was played on. Available values: Windows, Windows10, Windows81, Windows8, Windows7, WindowsVista, Windows2000, WindowsXp, Windows10Mobile, WindowsPhone81, WindowsPhone8, WindowsMobile7, WindowsMobile, Windows98, XboxOs, Android, Android5, Android5Tablet, Android4, Android4Tablet, Android4Wearable, Android3Tablet, Android2, Android2Tablet, Android1, AndroidMobile, AndroidTablet, ChromeOs, Webos, Palm, Meego, Ios, Ios9Iphone, Ios84Iphone, Ios83Iphone, Ios82Iphone, Ios81Iphone, Ios8Iphone, Ios7Iphone, Ios6Iphone, Ios5Iphone, Ios4Iphone, MacOsXIpad, Ios9Ipad, Ios84Ipad, Ios83Ipad, Ios82Ipad, Ios81Ipad, Ios8Ipad, Ios7Ipad, Ios6Ipad, MacOsXIphone, MacOsXIpod, MacOsX, MacOs, Maemo, Bada, GoogleTv, Kindle, Kindle3, Kindle2, Linux, Ubuntu, UbuntuTouchMobile, Symbian, Symbian9, Symbian8, Symbian7, Symbian6, Series40, SonyEricsson, SunOs, Psp, Wii, Blackberry, Blackberry7, Blackberry6, BlackberryTablet, Roku, Proxy, UnknownMobile, UnknownTablet, Unknown |
|User Agent | Browser	| browser	|Which browser the video was played on. Available values: Outlook, Outlook2007, Outlook2013, Outlook2010, Ie, OutlookExpress7, Iemobile11, Iemobile10, Iemobile9, Iemobile7, Iemobile6, IeXbox, Ie11, Ie10, Ie9, Ie8, Ie7, Ie6, Ie55, Ie5, Edge, Edge12, EdgeMobile12, Chrome, ChromeMobile, Chrome46, Chrome45, Chrome44, Chrome43, Chrome42, Chrome41, Chrome40, Chrome39, Chrome38, Chrome37, Chrome36, Chrome35, Chrome34, Chrome33, Chrome32, Chrome31, Chrome30, Chrome29, Chrome28, Chrome27, Chrome26, Chrome25, Chrome24, Chrome23, Chrome22, Chrome21, Chrome20, Chrome19, Chrome18, Chrome17, Chrome16, Chrome15, Chrome14, Chrome13, Chrome12, Chrome11, Chrome10, Chrome9, Chrome8, Omniweb, Safari, Blackberry10, MobileSafari, Silk, Safari9, Safari8, Safari7, Safari6, Safari5, Safari4, Coast, Coast1, Opera, OperaMobile, OperaMini, Opera34, Opera33, Opera32, Opera31, Opera30, Opera29, Opera28, Opera27, Opera26, Opera25, Opera24, Opera23, Opera20, Opera19, Opera18, Opera17, Opera16, Opera15, Opera12, Opera11, Opera10, Opera9, Konqueror, Dolfin2, AppleWebKit, AppleItunes, AppleAppstore, AdobeAir, LotusNotes, Camino, Camino2, Flock, Firefox, Firefox3mobile, FirefoxMobile, FirefoxMobile23, Firefox42, Firefox41, Firefox40, Firefox39, Firefox38, Firefox37, Firefox36, Firefox35, Firefox34, Firefox33, Firefox32, Firefox31, Firefox30, Firefox29, Firefox28, Firefox27, Firefox26, Firefox25, Firefox24, Firefox23, Firefox22, Firefox21, Firefox20, Firefox19, Firefox18, Firefox17, Firefox16, Firefox15, Firefox14, Firefox13, Firefox12, Firefox11, Firefox10, Firefox9, Firefox8, Firefox7, Firefox6, Firefox5, Firefox4, Firefox3, Firefox2, Firefox15, Thunderbird, Thunderbird12, Thunderbird11, Thunderbird10, Thunderbird8, Thunderbird7, Thunderbird6, Thunderbird3, Thunderbird2, Vivaldi, Seamonkey, Bot, BotMobile, Mozilla, Cfnetwork, Eudora, Pocomail, Thebat, Netfront, Evolution, Lynx, Download, Unknown, AppleMail|
|Geo | Country  |	country	 |Which country the video was played from. Available values: TBD  |
|Geo | City	| city|	Which city the video was played from.|
|Syndication & Attribution|Syndication Domain	|syndicationDomain|	The domain of the video publisher/syndicator|
|Syndication & Attribution|Syndication URL|	syndicationURL|	The canonical URL of the video publisher/syndicator. Canonical URL means lowercased, stripped querystring URL.|
|Syndication & Attribution|Application|	application|The name of the application on which the playback was delivered|
|Syndication & Attribution|Category	|category	|The categories which were assigned to the entry during playback|
|Syndication & Attribution|Playback Context	|playbackContext|	A specific category that was provided (using the embed code) to player during playback|
|Time |Day|	day	|Date (rounded to the beginning of day) of playback, for example: 30/03/2013 00:00:00|
|Time |Hour	|hour|	Date (rounded to the beginning of hour) of playback, for example: 30/03/2013 16:00:00|
|Time |Minute	|minute	|Date (rounded to the beginning of minute) of playback, for example: 30/03/2013 16:43:00|
|Time |10 Seconds	|10sec	|Date (rounded to the beginning of 10 seconds) of playback, for example: 30/03/2013 16:43:40|
|QoS|Streaming Protocol	|streamingProtocol	|The media streaming protocol that was used|
|QoS|Preferred Bitrate |	preferredBitrate |The bitrate of the preferred flavour that was set using the flash var.|
|QoS|UIConfID	|uiConfID	|Which player id and configuration the video was played on.|

### Custom Dimensions 

Video events can be aggregated by custom dimensions, currently 3 levels of hierarchy are supported.
In case you would like to use custom dimensions, specify their values on the player's embed code under the flashvars section:


    kWidget.embed({
    "targetId": "kaltura_player_1418811966",
    "wid": "_1091",
    "uiconf_id": 15190220,
    "cache_st": 1418811966,
    "entry_id": "0_f8re4ujs",
    "flashvars": {
        "kAnalony": {
            "plugin":true,
            "customVar1": "value1",
            "customVar2": "value2",
            "customVar3": "{mediaProxy.entryMetadata.metaDataFieldName}" // Data on entry's metadata can be also sent!
            },                                     
        "streamerType": "auto",
        "streamerType": "http"
        }
    });

