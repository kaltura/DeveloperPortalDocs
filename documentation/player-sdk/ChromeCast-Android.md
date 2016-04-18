## Google Cast setup

Kaltura supplies Chromecast plugin as default so if you don't need it you should add to your `KPPlayerConfig` :
```
config.addConfig("chromecast.plugin", "true");
```

You can use Chromecast button in 2 ways:

1. **Kaltura's Chromecast icon:**
	Managed by Kaltura SDK - the icon will be visible only when the first Chromecast device is detected when using the html5 controls.
2. **Your own custom button:**
	If you want the button to be part of the application and not part of the player.
	* `mPlayer.getKCastRouterManager().enableKalturaCastButton(false);`
	* 
	You can listen to:
	
	```java
	
	// Indicates when devices in range or not 
	@Override
    public void shouldPresentCastIcon(boolean shouldPresentOrDismiss) {

    }
	```
	When devices are in range you'll get notification to add device to your list.
	Once user clicked on the button you should show the device list and send the selected device using the `connectDevice(mRouterInfos.get(item).getRouterId())` function.
	Code example:
	
```
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
