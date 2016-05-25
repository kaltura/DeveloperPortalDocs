---
layout: page
title: Kaltura Player JavaScript API, Events and Hooks
weight: 403
---

The Player JavaScript API is a two-way communication channel that enables you to manage properties, event and notifications, including: 
* Enabling the Player to communicate its current states and parameters
* Enabling the embedding page/application to invoke actions, change and read properties, and to customize its behavior, design and layout 
* Maintaining a continuous, interactive data connection with the Kaltura Platform API
* Providing a seamless end user experience across devices, browsers and platforms

## Embed and Reference Player Instances  

The Player API is exposed via the Player JavaScript library and is only available when using the JavaScript embed methods (dynamic, thumbnail or auto). 

With iframe embed, communication with the parent DOM is sandboxed and thus requires the use of the postMessage API. If you require the use of an iframe embed, but need to establish an API communication, we recommend using the Kaltura **player.js** adapter, which acts as a postMessage bridge. 
If you are using Embed.ly, note that Kaltura.com Players are whitelisted for the embed.ly service.

The Kaltura Player's embed API is the first method you will interact with when using the Kaltura Player. This is the API that allows you to render Players on your page.
The kWidget API is available after you include the Kaltura Player library in your page. kWidget provides embedding and basic utility functions. 

> The Kaltura Player library can also be used inside Native Android and Native iOS applications using the respective Player SDK. See the [Kaltura Player Mobile SDK](https://vpaas.kaltura.com/documentation/05_Mobile-Video-Player-SDKs/Introduction.html) docs for more information about using the Kaltura Player in native mobile applications.

### Kaltura Player Embed API Methods  

To get started
1. Include the JavaScript tag to load the Kaltura Player library.
2. Substitute these tokens: 

  * {partner_id} - your Kaltura partner id (retrieved from KMC>Settings tab)
  * {uiconf_id} - the desired Kaltura player id  (retrieved from KMC>Studio tab)

```html
<script src="//cdnapisec.kaltura.com/p/{partner_id}/sp/{partnerId}00/embedIframeJs/uiconf_id/{uiconf_id}/partner_id/{partnerId}"></script>
```
After you have included the Kaltura Player library, the following kWidget API embed methods will be available:

* `kWidget.embed(targetId, settings)`: The most commonly used JavaScript embed method, after loading the DOM, the Kaltura Player will be rendered against the div whose ID was provided in `targetId`.
* `kWidget.thumbEmbed(targetId, settings)`: This method will render a thumbnail and play button to the `targetId` DOM element, and will only render the full Player when the end user clicks the Play button. The thumbnail embed will pass all of the configurations to the kWidget.embed when the Play button is clicked. The Player context menu can be disabled by setting the `EmbedPlayer.DisableContextMenu` UIVar to *true* using the flashvars or the Player Studio UIVars.

#### Embed API Method Parameters

* `targetId`: This string is the ID of the DOM element where the Player will be rendered (any contents of the element will be removed when the Player is rendered instead of this given element). 
* [`settings`](#the-kwidget-settings-object): This object is the object of the settings properties to be used when building and rendering the Player. 

#### kWidget Settings Object

| parameter       | type        | required         | description           |
|:---|:---|:---|:---|
| `targetId` | String | mandatory | The DOM Player target ID attribute strings if not defined as a top level param. |
| `partnerId` | String | mandatory | The ID of your Kaltura account (aka partnerId) (refer to the partner service, or visit the KMC>Settings tab to get your account partnerId). | 
| `wid` | String | mandatory | The Kaltura widget ID, this is usually set to the Kaltura account ID (i.e., the partnerId), prefixed by an underscore, e.g. `_8111441` (refer to the partner service, or visit the KMC>Settings tab to get your account partnerId). | 
| `entry_id` | String | mandatory | The entry ID of the media item (entry) to play, this parameter can be left empty for a JavaScript based entryId. Refer to the entry service, or visit the KMC>Content tab for the list of media entries in your account. If this is set to a playlistId, the Kaltura backend will stitch the playlist on the fly, and the Player will play back the playlist as if it was a single media entry (only manual playlists are accepted; refer to the playlist service or visit KMC>Content>Playlists for the list of playlists in your account). |
| `flashvars` | Object | mandatory | This is a runtime configuration object to set various player configurations and properties. These settings can override arbitrary UIVars and plugin configurations. |
| `uiconf_id` | Number | Optional | The ID of the Kaltura player to use (refer to the uiconf service or visit KMC>Studio for the list of Players in your account). |
| `readyCallback` | Function | Optional | The local callback method to be called once the Player is ready for bindings. The Player ID is passed as an argument. |
| `cache_st` | timestamp | Optional | Only set this in testing or development mode when performance is not required. If set to now+10min, this will rebuild the Player instead of serving the last instance from cache. Use only for testing while making changes to the Player. **Do not use this in production**. |

### Obtaining a Reference to the Embedded Player

To communicate with embedded Player instances via the JavaScript API, you will need to retrieve a reference to the Player instance. To obtain a reference to the Player,  you will need to implement the `readyCallback` function. `readyCallback` is called when the Player was successfully rendered to the DOM and is ready to accept API calls. 

There are two ways to implement the `readyCallback` function, which are described below.

#### Registering via the Global Library Facade  

```javascript
kWidget.addReadyCallback( function( playerId ){
    var kdp = document.getElementById( playerId ); 
    // kdp var now holds the player reference
});
``` 
This will register a global function that will be called once for every Player instance that will be rendered on the page. 

#### Passing the Handler Function to Each Individual Embed Call  

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

## Registering to Player Events (Hooks)  

You can register to Player events using the "kBind" method and un-register using the "kUnbind" method. 

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

### Using Event Namespaces  

It is highly recommended to define your own event namespaces when registering to Player events. This will prevent overriding event handlers when registering and unregistering events with multiple Player embeds on the same page. 

To use namespaces, postfix the event name with a dot and some alphanumeric string. 
For example: 

```javascript
kdp.kBind( "doPlay.myCustomNameSpace", function(){ ... });
```

Namespaces also provide the ability to un-register all events in the same namespace in one single call to kUnbind. For example:

```javascript
kdp.kUnbind('.myCustomNameSpace');
```

> Read more about event namespaces in the [jQuery documentation](https://api.jquery.com/event.namespace/). 

### Registering to the `playerReady` Event  

To ensure that the Player has been rendered and initialized properly before invoking Player methods or modifying Player properties, you will need to register to the player `playerReady` event.  This event is dispatched once all of the Player UI and plugins have been added and playback is ready to begin.

The best practice is to register to this event **before** calling any additional API method. Register to the `playerReady` event using the kBind method: 

```javascript
kWidget.addReadyCallback( function( playerId ){
    var kdp = document.getElementById( playerId );
    kdp.kBind( 'playerReady.myNamespace', function(){
	    console('player is ready to play!');
    })
});
```

### Commonly Used Player Events  

The following is a list of the most commonly used Player events triggered during typical Player embed and playback. Registering to these events enables the application to respond to the different states in the Player setup, Player lifecycle and end user interactions. 

| Event Name                | Parameters              | Description |
|:---|:---|:---|
| `layoutBuildDone`                | n/a              | Dispatched when the Player layout is ready and rendered on the screen                                                                                  |
| `playerReady`                    | n/a              | Dispatches when the Player is ready to play the media. The playerReady event is dispatched each time media is changed                                      |
| `mediaLoaded`                    | n/a              | MediaLoaded is triggered between each content load, i.e., once between every item in a playlist                                                          |
| `mediaError`                     | errorEvent       | The Player is notified about media errors                                                                                                                     |
| `playerStateChange`              | MediaPlayerState | Dispatched when the media Player's state has changed                                                                                                       |
| `firstPlay`                      | n/a              | Triggered once per content entry when first played. If the end user initiates a replay this is a new content playback sequence and will triger firstPlay again |
| `playerPlayed`                   | n/a              | Triggered when the Player enters a play state. This event may be triggered multiple times during a single playback session                                 |
| `playerPaused`                   | n/a              | The Player is now in a pause state                                                                                                                       |
| `preSeek`                        | seekTime         | Notifies about a seek activity that is about to start                                                                                                    |
| `seek`                           | currentTime      | Notifing about a seek activity that has started                                                                                                              |
| `seeked`                         | seekedTime       | Notifies that the seek activity has completed                                                                                                             |
| `playerUpdatePlayhead`           | currentTime      | An update event that notifies about the progress in time when playback is running                                                                      |
| `openFullScreen`                 | n/a              | The Player has entered full screen mode                                                                                                                        |
| `closeFullScreen`                | n/a              | The Player has exited full screen mode                                                                                                                    |
| `volumeChanged`                  | newVolume        | Notification about a change in the Player volume                                                                                                       |
| `mute`                           | n/a              | Notification fired when the Player is muted                                                                                                            |
| `unmute`                         | n/a              | Notification fired when the Player is unmuted                                                                                                          |
| `bufferChange`                   | buffering        | Dispatches when the Player starts or stops buffering                                                                                                   |
| `KalturaSupport_CuePointReached` | cuePointObject   | Notification fired when the Player reaches a cue point                                                                                                 |
| `KalturaSupport_AdOpportunity`   | cuePointObject   | Notification fired when the Player reaches an ad cue point (such as midroll or overlay)                                                                |
| `playerPlayEnd`                  | n/a              | The played media has reached the end of content playback.                                                                                              |
| `onChangeMedia`                  | n/a              | Change media operation started                                                                                                                         |
| `onChangeMediaDone`              | n/a              | Change media operation completed                                                                                                                       |

The following code example shows how the events above are triggered, and how their data and sequence throw log messages to the browser's console (use "Kaltura player" in the string filter):

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

### Commonly Used Player Ad Events (Ad Sequence Events)  

The Kaltura Player supports all of the major [IAB](http://www.iab.com/) ad standards. The most commonly used Player plugins for playing ads are VAST and Doubleclick.

When loading and placing ads, the Player dispatches many ad related events that can be used to gain knowledge on when the ad starts or stops, when an ad was clicked or skipped, the ad time (linear, overlay) and more. 

| Event Name                | Parameters              | Description  |
|:---|:---|:---|
| `adClick`                   | n/a                    | Dispatched when an ad is clicked by the end user |
| `adErrorEvent`              | n/a                    | Dispatched when an ad error occurs            |
| `AdSupport_EndAdPlayback`   | slotType               | Dispatched when an ad finishes playing         |
| `AdSupport_StartAdPlayback` | slotType               | Dispatched when an ad starts playing         |
| `midSequenceComplete`       | n/a                    | Dispatched when an midroll ad finishes playing |
| `midSequenceStart`          | n/a                    | Dispatched when an midroll ad starts playing |
| `onAdComplete`              | Ad ID, Ad current time | Dispatched when ad playback is complete      |
| `onAdPlay`                  | Ad ID, Ad System, Ad Type, Ad Position, Ad Duration, Ad Pod Position, Ad Pod start time, Ad title, Trafficking Parameters (DoubleClick only) | Dispatched when an ad starts playing and provides ad information. Additional info. |
| `onAdSkip`                   | n/a | Dispatched when an ad is skipped because the end user clicked the "Skip Ad" button |
| `postSequenceComplete` | n/a | Dispatched when an postroll ad finishes playing |
| `postSequenceStart`    | n/a | Dispatched when an postroll ad starts playing |
| `preSequenceComplete`  | n/a | Dispatched when an preroll ad finishes playing  |
| `preSequenceStart`    | n/a | Dispatched when an preroll ad starts playing  |


## Invoking Player Actions  

Invoking Player actions is done by calling the `sendNotification` method and passing the desired action name and respective parameters. The notifications sent to the Player instruct the Player and any loaded plugins to perform an action, such as play, seek, or pause.

```javascript
kWidget.addReadyCallback( function( playerId ){
    var kdp = document.getElementById( playerId );
    kdp.kBind( 'playerReady.myNamespace', function(){
	    //player will begin playing:
	    kdp.sendNotification("doPlay");
    })
});
```

### Commonly Called Player Notifications (Actions)  

The following are commonly-called Player notifications:
* To start playing: `kdp.sendNotification("doPlay");`
* To pause the playback: `kdp.sendNotification("doPause");`
* To seek the playhead for a specific time: `kdp.sendNotification("doSeek", 30);`
* To load a different media item (entry):  `kdp.sendNotification("changeMedia", { "entryId" : "0_wm82kqmm" });`
* To set the volume: `kdp.sendNotification("changeVolume", 0.5);`


## Reading Player Properties and Expressions  

The Kaltura Player allows evaluating Player properties using a curly brackets expressions syntax by using the `evaluate` command.
This feature allows you to get Player properties in real-time during playback, which provides information about the Player, media state and metadata.

```javascript
kWidget.addReadyCallback(function( playerId ){
		var kdp = document.getElementById( playerId );
		// alert the entry name
		alert('Entry name: '+ kdp.evaluate('{mediaProxy.entry.name}') 
	);
});
```

Beyond basic Player properties such as "playerVersion" or "duration", the Kaltura Player exposes access to nested Player objects with many additional properties. The objects are nested JSON objects, and are read from the evaluate method using a dot syntax (e.g., `myObj.nestedObj.property`).

### Commonly Used Data Objects  

The following are commonly used data objects:
| Object           | Description | 
|:---|:---|
| `configProxy`      | The Player configuration object. Allows access to all UI vars and plugin properties   |
| `mediaProxy`       | Holds all the currently loaded media properties                                       |
| `mediaProxy.entry` | Holds the entry metadata fields                                                       |
| `video`            | Holds properties of the currently playing video element                               |
| `video.player`     | Holds a reference to the Player with properties such as currentTime, width and height |
| `sequenceProxy`    | Represent all ads currently associated with the playing entry                         |

#### Evaluating Common Player Properties  

To evaluate common Player properties, using the following:
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

### Applying Formatters to Evaluated Player Properties  

When evaluating expressions, you can apply formatters to format the returned value using any of the available formatting functions or by adding custom formatters. 
Formatters are applied to evaluated properties by adding pipe (`|`) and the name of the formatters after the property. 

```javascript
// will print "video was watched 100000 times":
kdp.evaluate('video was watched {mediaProxy.entry.views} times');

// will print "video was watched 100,000 times":
kdp.evaluate('video was watched {mediaProxy.entry.views|numberWithCommas} times');
```

> **Using formatters in properties:**
> Formatters can be used in configuration properties as well. Simply passing the curly braces notation along with piped formatters in configuration properties using flashvars or UIVars will apply formatting to the properties.
> For example, to set the title bar to show the entry name and number of times it was watched (e.g., "My Awesome Video (10,000)"), add the following property to the flashvars:
>
> ```javascript
> "titleLabel": { 
	"plugin" : true,
	"text" :  "{mediaProxy.entry.name} ({mediaProxy.entry.views|numberWithCommas})" 
>}
> ```

#### Available Core Formatters  

* `timeFormat`: Takes time in seconds and returns hh:mm:ss format
* `dateFormat`: Takes a time stamp and returns javascript toString format
* `numberWithCommas`: Takes a number and returns a number with comas

> Custom formatters can be added by creating JavaScript player plugins. Read more about custom Player plugins and custom formatters.

## Setting Player Properties at Runtime  

To modify Player properties during runtime, use the `setKDPAttribute` command.  All Player and plugin properties can be set using a dot syntax. 
`setKDPAttribute (object, property, value);`

* **`object`:String**: A string that represents the object you want to modify. Use standard dot notation to specify sub-objects, for example: configProxy.flashvars
* **`property`:String**: The Player property that you want to modify
* **`value`:String**: he new value that you want to set for the Player property

For example: 

* To change the list of media items (entries) that will show in the Related Videos screen:

```javascript
kdp.setKDPAttribute('related', 'entryList', '0_33vkwid6,1_18leun9q,1_23pqn2nu');
```

* To hide the scrubber:

```javascript
kdp.setKDPAttribute('scrubber', 'visible', false);
```

> Note: Some properties are read-only or allow setting values only once during Player initialization.
