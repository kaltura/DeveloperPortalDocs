---
layout: page
title: Creating a New Analytics Plugin for the Kaltura Video Player on Android Devices
subcat: Android
weight: 296
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)


This article describes the steps required for building a New Analytics Plugin on Android devices.

## Create a New Class for the Plugin

The class must extend the PKPlugin to integrate with the Kaltura Video Player.

To configure the plugin protected functions, follow these steps: 

1. Add a factory function - this enables the Kaltura Video Player to create a new instance of the Analytics Plugin and register the new plugin.
```
public static final Factory factory = new Factory() {
        @Override
        public String getName() {
            return "NameOfPlugin";
        }

        @Override
        public PKPlugin newInstance() {
            return new GenericAnalyticsPlugin(); //Name of the plugin class
        }
    };
```

2. When the application sets the Analytics Plugin configuration, the Kaltura Video Player calls the plugin onLoad method. This function contains all of the required configurations for the new plugin, a reference to the active Kaltura Video Player, and a reference to the MessageBus, which includes all events.

3. Add a listener to the relevant events by calling the following function - all of the relevant events will follow the listener:  
```
messageBus.listen(hereComesTheEventListener, PlayerEvent.Type.PLAY, PlayerEvent.Type.PAUSE, PlayerEvent.Type.ENDED, PlayerEvent.Type.ERROR, PlayerEvent.Type.LOADED_METADATA);
```

4. Add a send analytics event method and call it from the event listener.

5. If you want to report events to the application, you can use LogEvent in the following way: 
```
messageBus.post(new LogEvent(TAG + " " + ((PlayerEvent) event).type.toString()));
```

6. The methods onDestroy, onUpdateConfig, onUpdateMedia, onApplicationPaused, and onApplicationResumed help you manage the life cycle of your Analytics Plugin, including initiating end events, handling background tasks, and keeping the plugin flow in accordance with the Video Player life cycle.

## Enable the the Analytics Plugin for the Kaltura Video Player on Android Devices  

Register the Analytics Plugin inside the application as follows:

```
PlayKitManager.registerPlugins(GenericAnalyticsPlugin.factory);
```

## Configure the Plugin Configuration Object for the Analytics Plugin  

To configure the Analytics Plugin, add the following configuration to your `pluginConfig` file:

```
private void configureGenericAnalyticsPlugin(PlayerConfig pluginConfig) {
        JsonObject genericConfigEntry = new JsonObject();
        genericConfigEntry.addProperty("NameOfThe Configuration", value of the configuration);
```

## Set the plugin config to the Plugin

In order for the Plugin to start loading, you need to set
the plugin config you created -

```
PlayerConfig config = new PlayerConfig();
PlayerConfig.Plugins plugins = config.plugins;
plugins.setPluginConfig("NameOfPlugin" , genericConfigEntry.toJson()); 
```

## MessageBus Supported Events  

```
PlayerEvents{
public enum Type {
        STATE_CHANGED, //IDLE, LOADING, READY, BUFFERING;
        CAN_PLAY,   // Sent when enough data is available that the media can be played, at least for a couple of frames. This corresponds to the HAVE_ENOUGH_DATA readyState.
        DURATION_CHANGE,   //  The metadata has loaded or changed, indicating a change in duration of the media. This is sent, for example, when the media has loaded enough that the duration is known.
        ENDED,   //  Sent when playback completes.
        ERROR,   //  Sent when an error occurs. The element's error attribute contains more information. See Error handling for details.
        LOADED_METADATA,   //  The media's metadata has finished loading; all attributes now contain as much useful information as they're going to.
        PAUSE,   //  Sent when playback is paused.
        PLAY,   //  Sent when playback of the media starts after having been paused; that is, when playback is resumed after a prior pause event.
        PLAYING,   //  Sent when the media begins to play (either for the first time, after having been paused, or after ending and then restarting).
        SEEKED,   //  Sent when a seek operation completes.
        SEEKING,   //  Sent when a seek operation begins.
        TRACKS_AVAILABLE, // Sent when track info is available.
        REPLAY, //Sent when replay happened.
        PLAYBACK_PARAMS, // Sent event that notify about changes in the playback parameters. When bitrate of the video or audio track changes or new media loaded. Holds the PlaybackParamsInfo.java object with relevant data.
        VOLUME_CHANGED // Sent when volume is changed.
    }
```
```
AdEvents{
public enum Type {
        STARTED,
        PAUSED,
        RESUMED,
        COMPLETED,
        FIRST_QUARTILE,
        MIDPOINT,
        THIRD_QUARTILE,
        SKIPPED(),
        CLICKED,
        TAPPED,
        ICON_TAPPED,
        AD_BREAK_READY,
        AD_PROGRESS,
        AD_BREAK_STARTED,
        AD_BREAK_ENDED,
        CUEPOINTS_CHANGED,
        LOADED,
        CONTENT_PAUSE_REQUESTED,
        CONTENT_RESUME_REQUESTED,
        ALL_ADS_COMPLETED
    }
```

## Adding New Events Using the MessageBus  

If you have new events you need to report, you can add new events by implementing the following steps: 

1. Add a new class for your event.
2. Implement the PKEvent in this class according the following implementation example: 
```
public class NewAnalyticsEvent implements PKEvent {
    public final NewAnalyticsEvent.EventType type;

    public enum EventType
    {Concurrency}

    public NewAnalyticsEvent(NewAnalyticsEvent.EventType type) {
        this.type = type;
    }


    @Override
    public Enum eventType() {
        return this.type;
    }

}
```

3. Use the Messagebus to post your new event: 
```
messageBus.post(new NewAnalyticsEvent(TAG + " " + ((NewAnalyticsEvent) event).type.toString()));
```

## Code Examples

### Event Listener  

```
private PKEvent.Listener mEventListener = new PKEvent.Listener() {
        @Override
        public void onEvent(PKEvent event) {
            if (event instanceof PlayerEvent) {
                log.d(((PlayerEvent) event).type.toString()); //using the built in kaltura player logger
                switch (((PlayerEvent) event).type) {
                    case ENDED:
                        sendAnalyticsEvent(PhoenixActionType.FINISH);
                        break;
                    case ERROR:
                        sendAnalyticsEvent(PhoenixActionType.ERROR);
                        break;
                    case LOADED_METADATA:
                        sendAnalyticsEvent(PhoenixActionType.LOAD);
                        break;
                    case PAUSE:
                        sendAnalyticsEvent(PhoenixActionType.PAUSE);
                        break;
                    case PLAY:
                        if (!intervalOn){
                            startMediaHitInterval();
                            intervalOn = true;
                        }
                        if (isFirstPlay) {
                            isFirstPlay = false;
                            sendAnalyticsEvent(PhoenixActionType.FIRST_PLAY);
                        } else {
                            sendAnalyticsEvent(PhoenixActionType.PLAY);
                        }
                        break;
                    default:
                        break;
                }
            }
        }
    };
```

### onDestroy  

```
   @Override
    public void onDestroy() {
        log.d("onDestroy");
        sendAnalyticsEvent(PhoenixActionType.STOP);
    }
```

### onApplicationPaused  

```
@Override
    protected void onApplicationPaused() {
        stopMonitoring();
    }
```

### onApplicationResumed  

```
    @Override
    protected void onApplicationResumed() {
        startMonitoring(this.player);
    }
```
