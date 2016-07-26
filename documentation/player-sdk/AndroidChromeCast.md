---
layout: page
title: Google Cast Setup 
---

## Introduction

The Cast functionality will allow your videos to be cast from a Android mobile device via the Chromecast plugin directly to a Kaltura Player receiver app on a Chromecast-connected TV.

## Basic Definitions

`Sender` - A Cast enabled Kaltura Player running inside of an Android Application. The Kaltura Player requires a sender App ID.

`Receiver` - A Kaltura Player receiver application that runs on the Chromecast device. The receiver application 


### Get Started
To begin casting follow these steps:

* After `KPPlayerConfig config` creation 

```
KPPlayerConfig config = new KPPlayerConfig("{your-server-id}", "{your-ui-conf-id}", "{your-pqrtner-id}").setEntryId("{your-entry_id}");
```

* Add the following to your `config` instance

```
config.addConfig("chromecast.plugin", "true");
config.addConfig("chromecast.useKalturaPlayer", "true");             
```


#### Scan for devices


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


        
#### Connect to Device

* When some device was chosen connect to a device by calling


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


#### Cast the Media

* To cast, set the `mCastProvider` property under `PlayerViewController` with `KCastProvider` object you created.

```
mPlayer.setCastProvider(mCastProvider);
```

#### Disconnect from Device

* To disconnect from a device use

```
mCastProvider.disconnectFromDevcie();
```


### Media Remote Control
The `KCastProvider` has a `KCastMediaRemoteControl` instance that controls the playback of the video being casted, and the `KCastMediaRemoteControlDelegate` will provide you with the playback callbacks while casting.
For example

```
// To play the memdia
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

A best practice sample application demonstrating the code necessary for a proper casting experience can be found on https://github.com/kaltura/player-sdk-demo-ios/tree/master/ovp/CCDemo. 

This repository contains several basic best practice apps that use the Kaltura iOS Player SDK.
