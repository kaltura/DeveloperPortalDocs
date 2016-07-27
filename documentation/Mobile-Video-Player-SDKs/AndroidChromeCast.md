---
layout: page
title: Google Cast Setup
subcat: Android
weight: 310
---

## Introduction

The Cast functionality allows your videos to be cast from a Android mobile device, via the Chromecast plugin, directly to a Kaltura Player receiver app on a Chromecast-connected TV.

### Before You Begin  

Before you begin setting up the Cast feature, make sure you've read the article [Android Player SDK and Environment Setup - Getting Started](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/Android-Getting-Started.html).

## Basic Definitions

* `Sender` - A Cast enabled Kaltura Player running inside of a iOS Application; the Kaltura Player requires a Sender App ID.
* `Receiver` - A Kaltura Player Receiver App that runs on the Chromecast device.


### Getting Started  

To begin casting, follow these steps:

1. Create the `KPPlayerConfig config` as follows:
        ```
        KPPlayerConfig config = new KPPlayerConfig("{your-server-id}", "{your-ui-conf-id}", "{your-pqrtner-id}").setEntryId("{your-entry_id}");
        ```
2. Next, add the following to your `config` instance:

```
          config.addConfig("chromecast.plugin", "true");
config.addConfig("chromecast.useKalturaPlayer", "true");             
```

#### Scanning for Devices  

To scan for devices, use the following:

```
mCastProvider = KCastFactory.createCastProvider();
mCastProvider.setKCastProviderListener(new KCastProvider.KCastProviderListener() {
            @Override
            public void onCastMediaRemoteControlReady(KCastMediaRemoteControl castMediaRemoteControl) {
					// You can save the instance and use it for controling the media channel.
            }

            @Override
            public void onDeviceCameOnline(KCastDevice device) {
                
            }

            @Override
            public void onDeviceWentOffline(KCastDevice device) {
                
            }

            @Override
            public void onDeviceConnected() {
                
            }

            @Override
            public void onDeviceDisconnected() {
                
            }

            @Override
            public void onDeviceFailedToConnect(KPError error) {

            }

            @Override
            public void onDeviceFailedToDisconnect(KPError error) {

            }
        });
        mCastProvider.startScan(getApplicationContext(), "C43947A1");
       
        
```

#### Connecting to Devices

After selecting a detected device, connect to the device by calling the following:


```
private void presentCCDevices() {
        final ArrayList<KCastDevice> devices = mCastProvider.getDevices();
        final String[] items = new String[devices.size()];
        for (int i = 0; i < items.length; i++   ) {
            items[i] = devices.get(i).getRouterName();
        }
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Make your selection");
        builder.setItems(items, new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int item) {
                // Do something with the selection
                mCastProvider.connectToDevice(devices.get(item));
            }
        });
        AlertDialog alert = builder.create();
        alert.show();

    }
```


#### Casting Media

To cast media, set the `mCastProvider` property under `PlayerViewController` with the `KCastProvider` object you created as follows:

```
mPlayer.setCastProvider(mCastProvider);
```


#### Disconnecting from a Device

To disconnect from a device use the following:

```
mCastProvider.disconnectFromDevcie();
```

### Using the Media Remote Control  

The `KCastProvider` includes a `KCastMediaRemoteControl` instance that controls the playback of the video being cast; using the  `KCastMediaRemoteControlDelegate` will provide you with the playback callbacks while casting.

For example:

```
// To play the media
mCastProvider.getCastMediaRemoteControl().play();

mCastProvider.setKCastProviderListener(new KCastProvider.KCastProviderListener() {
            @Override
            public void onCastMediaRemoteControlReady(KCastMediaRemoteControl castMediaRemoteControl) {
                mCastProvider.getCastMediaRemoteControl().addListener(new KCastMediaRemoteControl.KCastMediaRemoteControlListener() {
                    @Override
                    public void onCastMediaProgressUpdate(long currentPosition) {
                        
                    }

                    @Override
                    public void onCastMediaStateChanged(KCastMediaRemoteControl.State state) {

                    }
                });
            }
```

### Demo Application  

A best practice sample application, which demonstrates the code that is required for a proper casting experience, can be found in this [demo](https://github.com/kaltura/player-sdk-demo-ios/tree/master/ovp/CCDemo). 

This repository contains several basic best practice applications that use the Kaltura iOS Player SDK.
