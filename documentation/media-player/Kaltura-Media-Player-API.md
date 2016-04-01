---
layout: page
title: Kaltura Media Player API
---

The Player JavaScript API is a two-way communication channel that lets the player communicate it's current states and parameters and enables the embedding page/app to invoke actions, change and read properties, customize its behavior, design and layout, all while maintaining a continuous, interactive data connection with the Kaltura platform API and seamless end-user experience across devices, browsers and platforms. 

This page provides detailed reference to all of the Kaltura player API methods, events and properties.

## Embed and Reference Player Instances
The Player API is exposed via the player JavaScript library and is available only when using the JavaScript embed methods (dynamic, thumbnail or auto). 

With iframe embed, communication with the parent DOM is sandboxed and thus requires the use of the postMessage API. If you require the use of iframe embed, and still need to establish API communication, we recommend using the Kaltura player.js adapter which acts as a postMessage bridge. 
If you're using Embed.ly, note that Kaltura.com players are whitelisted for the embed.ly service.

The Kaltura Player's embed API is the first method you will interact with when using the Kaltura player. It is the API that allows you to render players on your page.
The kWidget API is available after you include the Kaltura player library in your page. kWidget provides embedding and basic utility functions. 

> The Kaltura player library can also be used inside Native Android and Native iOS applications using the respective player SDK. See the Kaltura Player Mobile SDK docs for more information about using the Kaltura Player in native mobile apps.

### Kaltura Player Embed API Methods
To get started, include the JavaScript tag to load the Kaltura player library:
Substitute these tokens: 

* {partner_id} - your Kaltura partner id (retrieved from KMC>Settings tab)
* {uiconf_id} - the desired Kaltura player id  (retrieved from KMC>Studio tab)

```html
<script src="//cdnapisec.kaltura.com/p/{partner_id}/sp/{partnerId}00/embedIframeJs/uiconf_id/{uiconf_id}/partner_id/{partnerId}"></script>
```

After you've included the Kaltura player library, the following kWidget API embed methods will be available to you:

* **`kWidget.embed(targetId, settings)`** - The most commonly used JavaScript embed method, upon DOM load, the Kaltura player will be rendered against the div who's id was provided in `targetId`.
* **`kWidget.thumbEmbed(targetId, settings)`** - This method will render a thumbnail and play button to the `targetId` DOM element, and only render the full player when the user clicks on the play button. Thumbnail embed will pass all the configuration to the kWidget.embed when the play button is clicked. The player context menu can be disabled by setting the `EmbedPlayer.DisableContextMenu` UIVar to true either via flashvars or Player Studio UIVars.

#### The embed API methods parameters
* **`targetId`:String** - Id of the DOM element where the player will be rendered (the id will be replaced with the player - any contents of this element will be removed when the player is rendered). 
* [**`settings`:Object**](#the-kwidget-settings-object) - Object of settings properties to be used when building and rendering the player. | dynamic embed recipe

#### The kWidget Settings Object

| parameter       | type        | required/optional         | description           |
|:---|:---|:---|:---|
| `targetId` | String | mandatory | The DOM player target id attribute string if not defined as top level param. |
| `wid` | String | mandatory | The Kaltura widget id. Most commonly, this is set to Kaltura account id (aka partnerId)  prefixed by underscore, e.g. `_8111441`. (Refer to the partner service, or visit the KMC>Settings tab to get your account partnerId). | 
| `entry_id` | String | mandatory | The entry id of the media item (entry) to play. Can be left empty for a JavaScript based entryId. (Refer to the entry service, or visit the KMC>Content tab for the list of media entries in your account). If this is set to a playlistId, the Kaltura backend will stitch the playlist on the fly, and the player will play back the playlist as if it was a single media entry (Only manual playlists accepted. Refer to the playlist service or visit KMC>Content>Playlists for the list of playlists in your account). |
| `flashvars` | Object | mandatory | Runtime configuration object to set various player configurations and properties. These settings can override arbitrary UIVars and plugin configurations. |
| `uiconf_id` | Number | Optional | The id of the Kaltura player to use (Refer to the uiconf service or visit KMC>Studio for list of players in your account). |
| `readyCallback` | Function | Optional | Local callback method to be called once player is ready for bindings. Player id is passed as an argument. |
| `cache_st` | timestamp | Optional | Only set this in testing or development mode when performance is not required. If set to now+10min will rebuild the player instead of serving the last instance from cache. Use only for testing while making changes to the player. Do not use this in production. |

### Obtaining a reference to the embedded player
In order to communicate with embedded player instances via the JavaScript API, a reference to the player instance must be retrieved. To gain a reference to the player,  you should implement the `readyCallback` function. `readyCallback` is called when the player was successfully rendered to the DOM and is ready to accept API calls. 

There are two ways to implement the `readyCallback` function:

#### Registering via the global library facade
```javascript
kWidget.addReadyCallback( function( playerId ){
    var kdp = document.getElementById( playerId ); 
    // kdp var now holds the player reference
});
``` 
This will register a global function which will be called once for every player instance that will be rendered on the page. 

#### Passing handler function to each individual embed call
```javascript
kWidget.embed({
    'targetId': 'kaltura_player',
    'wid': '_243342',
    'uiconf_id' : '12905712',
    'entry_id' : '0_uka1msg4',
    'readyCallback' : function( playerId ){
        var kdp = document.getElementById( playerId ); 
        // kdp var now holds the player reference
    },
});
```

## Register to player events (hooks)
You can register to player events using the "kBind" method and un-register using the "kUnbind" method. 

```javascript
kWidget.addReadyCallback( function( playerId ){
	var kdp = document.getElementById( playerId );
	var foo = "bar";
	// using kBind we will register to player's play event
	kdp.kBind( "doPlay", function(){ 
		// console will log "play bar":
		console.log("play " + foo); 
		// stop listening to the play event using kUnbind:
		kdp.kUnbind('doPlay');
	});
});
```

### Using event namespaces
It is highly recommended to define your own event namespaces when registering to player event. 
This will prevent overriding event handlers when registering and unregistering events with multiple player embeds on the same page. 
To use namespaces, postfix the event name with a dot and some alphanumeric string. For example: 
```javascript
kdp.kBind( "doPlay.myCustomNameSpace", function(){ ... });
```
Namespaces also provide the ability to un-register all events in the same namespace in one single call to kUnbind. For example:
```javascript
kdp.kUnbind('.myCustomNameSpace');
```
> Read more about event namespaces in the [jQuery documentation](https://api.jquery.com/event.namespace/). 

### Registering to the `playerReady` event
To ensure that the player has been rendered and initialized properly before invoking player methods or modifying player properties register to the player `playerReady` event.  This event is dispatched once all of the player UI and plugins were loaded and playback is ready to begin playback.

The best practice is to register to this event before calling any additional API method. Register to the `playerReady` event using the kBind method: 
```javascript
kWidget.addReadyCallback( function( playerId ){
    var kdp = document.getElementById( playerId );
    kdp.kBind( 'playerReady.myNamespace', function(){
	    console('player is ready to play!');
    })
});
```

### Commonly used player events
Below is a list of the most commonly used player events triggered during typical player embed and playback. Registering to these events enables to respond to the different states in the player setup, playback lifecycle and user interactions. 

| Event Name                | Parameters              | Description |
|:---|:---|:---|
| `layoutBuildDone`                | n/a              | Dispatched when the player layout is ready and rendered on the screen                                                                                  |
| `playerReady`                    | n/a              | Dispatches when the player is ready to play the media. playerReady event is dispatched each time media is changed                                      |
| `mediaLoaded`                    | n/a              | MediaLoaded is triggered between each content load. i.e once between every item in a playlist                                                          |
| `mediaError`                     | errorEvent       | The player notify on media error                                                                                                                       |
| `playerStateChange`              | MediaPlayerState | Dispatched when media player's state has changed                                                                                                       |
| `firstPlay`                      | n/a              | Triggered once per content entry when first played. If user initiates a replay this is a new content playback sequence and will triger firstPlay again |
| `playerPlayed`                   | n/a              | Triggered when the player enters a play state. This event be triggered multiple times during a single playback session                                 |
| `playerPaused`                   | n/a              | The player is now in pause state                                                                                                                       |
| `preSeek`                        | seekTime         | Notify about a seek activity that is about to start                                                                                                    |
| `seek`                           | currentTime      | Notify about a seek activity that started                                                                                                              |
| `seeked`                         | seekedTime       | Notify that the seek activity has finished                                                                                                             |
| `playerUpdatePlayhead`           | currentTime      | An update event that notifies about the progress in time when playback is running                                                                      |
| `openFullScreen`                 | n/a              | Player entered full screen mode                                                                                                                        |
| `closeFullScreen`                | n/a              | Player exited from full screen mode                                                                                                                    |
| `volumeChanged`                  | newVolume        | Notification about a change in the player volume                                                                                                       |
| `mute`                           | n/a              | Notification fired when the player is muted                                                                                                            |
| `unmute`                         | n/a              | Notification fired when the player is unmuted                                                                                                          |
| `bufferChange`                   | buffering        | Dispatches when the player starts or stops buffering                                                                                                   |
| `KalturaSupport_CuePointReached` | cuePointObject   | Notification fired when the player reaches a cue point                                                                                                 |
| `KalturaSupport_AdOpportunity`   | cuePointObject   | Notification fired when the player reaches an ad cue point (such as midroll or overlay)                                                                |
| `playerPlayEnd`                  | n/a              | The played media has reached the end of content playback.                                                                                              |
| `onChangeMedia`                  | n/a              | Change media operation started                                                                                                                         |
| `onChangeMediaDone`              | n/a              | Change media operation completed                                                                                                                       |

The following code example shows how the above events are triggered, their data and sequence by throwing log messages to the browser's console (use "Kaltura player" in the string filter):
```html
<div id="kaltura_player" style="width:400px;height:330px;"></div>
<script>
kWidget.embed({
    'targetId': 'kaltura_player',
    'wid': '_243342',
    'uiconf_id' : '12905712',
    'entry_id' : '0_uka1msg4',
    'readyCallback':function(playerID) {
        var kdp = document.getElementById(playerID);
        var events = ['layoutBuildDone', 'playerReady',  'mediaLoaded', 'mediaError', 'playerStateChange', 'firstPlay', 'playerPlayed', 'playerPaused', 'preSeek', 'seek', 'seeked', 'playerUpdatePlayhead', 'openFullScreen', 'closeFullScreen', 'volumeChanged', 'mute', 'unmute', 'bufferChange', 'cuePointReached', 'playerPlayEnd', 'onChangeMedia', 'onChangeMediaDone'];
        for ( var i=0; i < events.length; i++ ){
            (function(i) {
                kdp.kBind( events[i], function(event){
                    console.log('Kaltura player event triggered: ' + events[i] + ', event data: ' + JSON.stringify(event));
                });
            })(i);
        }
    }
});
</script>
```

### Commonly used player ad events (ad sequence events)
The Kaltura player supports all of the major [IAB](http://www.iab.com/) ad standards. The most commonly used player plugins for playing ads are VAST and Doubleclick.
When loading and placing ads, the player dispatches many ad related events that can be used to gain knowledge on when the ad starts, stops, when an ad was clicked or skipped, the ad time (linear, overlay) and more. 

| Event Name                | Parameters              | Description  |
|:---|:---|:---|
| `adClick`                   | n/a                    | Dispatched when an ad is clicked by the user |
| `adErrorEvent`              | n/a                    | Dispatched when an ad error occur            |
| `AdSupport_EndAdPlayback`   | slotType               | Dispatched when an ad finish playing         |
| `AdSupport_StartAdPlayback` | slotType               | Dispatched when an ad starts playing         |
| `midSequenceComplete`       | n/a                    | Dispatched when an midroll ad finish playing |
| `midSequenceStart`          | n/a                    | Dispatched when an midroll ad starts playing |
| `onAdComplete`              | Ad ID, Ad current time | Dispatched when ad playback is complete      |
| `onAdPlay`                  | Ad ID, Ad System, Ad Type, Ad Position, Ad Duration, Ad Pod Position, Ad Pod start time, Ad title, Trafficking Parameters (DoubleClick only) | Dispatched when an ad starts playing and provides ad information. Additional info. |
| `onAdSkip`                   | n/a | Dispatched when an ad is skipped due to the user clicking the "Skip Ad" button |
| `postSequenceComplete` | n/a | Dispatched when an postroll ad finish playing |
| `postSequenceStart`    | n/a | Dispatched when an postroll ad starts playing |
| `preSequenceComplete`  | n/a | Dispatched when an preroll ad finish playing  |
| `preSequenceStart`    | n/a | Dispatched when an preroll ad starts playing  |


## Invoking player actions
Invoking player actions is done by calling the `sendNotification` method, passing the desired action name and respective parameters. 
The notifications sent to the player instruct the player and any loaded plugins to perform an action, such as play, seek, or pause.
```javascript
kWidget.addReadyCallback( function( playerId ){
    var kdp = document.getElementById( playerId );
    kdp.kBind( 'playerReady.myNamespace', function(){
	    //player will begin playing:
	    kdp.sendNotification("doPlay");
    })
});
```

### Commonly called player notifications (actions)
* To start playing: `kdp.sendNotification("doPlay");`
* To pause the playback: `kdp.sendNotification("doPause");`
* To seek the playhead to specific time: `kdp.sendNotification("doSeek", 30);`
* To load a different media item (entry):  `kdp.sendNotification("changeMedia", { "entryId" : "0_wm82kqmm" });`
* To set the volume: `kdp.sendNotification("changeVolume", 0.5);`


## Reading player properties and expressions
The Kaltura player allows evaluating player properties using a curly brackets expressions syntax, using the `evaluate` command.
This feature allows you to get player properties at real time during playback thus gaining information about player, media state and metadata.

```javascript
kWidget.addReadyCallback(function( playerId ){
		var kdp = document.getElementById( playerId );
		// alert the entry name
		alert('Entry name: '+ kdp.evaluate('{mediaProxy.entry.name}') 
	);
});
```

Beyond basic player properties such as "playerVersion" or "duration", the Kaltura player exposes access to nested player objects with many additional properties. The objects are nested JSON objects, read from the evaluate method using dot syntax (e.g. `myObj.nestedObj.property`).

### Commonly used data objects
| Object           | Description | 
|:---|:---|
| `configProxy`      | The player configuration object. Allows access to all UI vars and plugin properties   |
| `mediaProxy`       | Holds all the currently loaded media properties                                       |
| `mediaProxy.entry` | Holds the entry metadata fields                                                       |
| `video`            | Holds properties of the currently playing video element                               |
| `video.player`     | Holds a reference to the player with properties such as currentTime, width and height |
| `sequenceProxy`    | Represent all ads currently associated with the playing entry                         |

#### Evaluating common player properties

* Get current media duration: `kdp.evaluate('{duration}');`
* Get current media entry name: `kdp.evaluate('{mediaProxy.entry.name}');`
* Check if the currently playing media is live: `kdp.evaluate('{mediaProxy.isLive}');`
* Get current entry metadata: `kdp.evaluate('{mediaProxy.entryMetadata}'); `
* Get current entry cue points: `kdp.evaluate('{mediaProxy.entryCuePoints}');`
* Get current video volume: `kdp.evaluate('{video.volume}');`
* Get current video time: `kdp.evaluate('{video.player.currentTime}');`
* Determine if an ad is currently playing: `kdp.evaluate('{sequenceProxy.isInSequence}');`
* Get current ad duration: `kdp.evaluate('{sequenceProxy.duration}');`
* Get time remaining until ad finish playback: `kdp.evaluate('{sequenceProxy.timeRemaining}');`

### Applying formatters to evaluated player properties
When evaluating expressions, you can apply formatters to format the returned value using any of the available formatting functions or by adding custom formatters. 
Formatters are applied to evaluated properties by adding pipe (`|`) and the name of the formatters after the property. 

```javascript
// will print "video was watched 100000 times":
kdp.evaluate('video was watched {mediaProxy.entry.views} times');

// will print "video was watched 100,000 times":
kdp.evaluate('video was watched {mediaProxy.entry.views|numberWithCommas} times');
```

> **Using formatters in properties:**
> Formatters can be used in configuration properties as well. Simply passing the curly braces notation along with piped formatters in configuration properties in flashvars or UIVars will apply formatting to the properties.
> For example, to set the title bar to show the entry name and number of times it was watched (eg. "My Awesome Video (10,000)"), add to the flashvars the following property:
> ```
> "titleLabel": { 
	"plugin" : true,
	"text" :  "{mediaProxy.entry.name} ({mediaProxy.entry.views|numberWithCommas})" 
>}
> ```

#### Available core formatters:
* `timeFormat` - takes time in seconds and returns hh:mm:ss format
* `dateFormat` - takes a time stamp returns javascript toString format
* `numberWithCommas` - takes a number and returns number with comas

> Custom formatters can be added by creating JavaScript player plugins. Read more about custom player plugins and custom formatters.

## Setting player properties at runtime
To modify player properties during runtime, use the `setKDPAttribute` command.  All player and plugin properties can be set using a dot syntax. 
`setKDPAttribute (object, property, value);`

* **`object`:String** - A string that represents the object you want to modify. Use standard dot notation to specify sub-objects, for example: configProxy.flashvars
* **`property`:String** - The player property that you want to modify.
* **`value`:String** - The new value that you want to set for the player property.

For example: 

* To change the list of media items (entries) that will show in the Related Videos screen:
```javascript
kdp.setKDPAttribute('related', 'entryList', '0_33vkwid6,1_18leun9q,1_23pqn2nu');
```
* To hide the scrubber:
```javascript
kdp.setKDPAttribute('scrubber', 'visible', false);
```

> **Note:** Some properties are read-only or allow setting values only once during player initialization.
