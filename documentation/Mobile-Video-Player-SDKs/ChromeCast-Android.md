
layout: page
title: Google Cast Setup for Android Devices
subcat: SDK 2.0 - Android
weight: 310

This article describes how to set up the Google Cast feature in Android devices.

Note that Kaltura provides the Chromecast plugin as default; if you plan to use it, you should add the following to your `KPPlayerConfig` :
```
config.addConfig("chromecast.plugin", "true");
```
The Kaltura Player will handle all of the cast logic and playback; you will need to handle the UI of the devices and send the selected device(s) to the SDK.

In this article, we'll show you how to use the Chromecast plugin in Android devices. This can be implemented in one of two ways:

1. **Kaltura's Chromecast icon:**
	Managed by the Kaltura SDK, the icon will be visible only when the first Chromecast device is detected when using the html5 controls.
2. **Your own custom button:**
	Use this option if you want the button to be part of the application and not part of the Player.
	* `mPlayer.getKCastRouterManager().enableKalturaCastButton(false);`
	* 
	You can listen to:
	
	```java
	
	// Indicates when devices in range or not 
	@Override
    public void shouldPresentCastIcon(boolean shouldPresentOrDismiss) {

    }
	```
	When devices are in range, you'll get a notification to add the device to your list.
	when the end user clicks the button, you should show the device list and send the selected device using the `connectDevice(mRouterInfos.get(item).getRouterId())` function.
	Code example:
	
```java
mPlayer.getKCastRouterManager().setCastRouterManagerListener(new KCastRouterManagerListener() {
                @Override
                public void onCastButtonClicked() {
                    if (!isCCActive) {
                        presentCCDevices();
                    } else {
                        mPlayer.getKCastRouterManager().disconnect();
                    }
                }

                @Override
                public void onApplicationStatusChanged(boolean isConnected) {
                    isCCActive = isConnected;
                }

                @Override
                public void shouldPresentCastIcon(boolean didDetect) {

                }

                @Override
                public void onAddedCastDevice(KRouterInfo info) {
                    mRouterInfos.add(info);
                }

                @Override
                public void onRemovedCastDevice(KRouterInfo info) {
                    mRouterInfos.remove(info);
                }
            });

    private void presentChromecastDevices() {
        final String[] items = new String[mRouterInfos.size()];
        for (int i = 0; i < items.length; i++   ) {
            items[i] = mRouterInfos.get(i).getRouterName();
        }
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Make your selection");
        builder.setItems(items, new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int item) {
                // Do something with the selection
                mPlayer.getKCastRouterManager().connectDevice(mRouterInfos.get(item).getRouterId());
            }
        });
        AlertDialog alert = builder.create();
        alert.show();

    }
