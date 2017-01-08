---
layout: page
title: Setting up Offline Playback on Android Devices
subcat: Android Version 3.0
weight: 294
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

This article describes how to implement offline playback in Playkit SDK on Android devices. 

First, download the media you wish to playh. If you are looking for a good download manager you can use [this](https://github.com/kaltura/playkit-dtg-android) one. In general the most complex part of the playback in offline is managing the DRM content license, but we've already covered that issue for you.

## Registering the Asset  

First, you'll need to create an instance of the [LocalAssetManager](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/LocalAssetsManager.java).

Note that you have two constructors for this object; however, the first constructor only receives Android context.

>**Important!** The context must be the Android Application context.

  ```
  //Create new instance of localAssetManager with default implementatoin of LocalDrmStorage.
LocalAssetsManager localAssetsManager = new LocalAssetsManager(context);
  ```

The second accept additional parameter of type [LocalDrmStorage](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/LocalDrmStorage.java).

```
//Create new instance of localAssetManager with custom implementatoin of LocalDrmStorage.
LocalAssetsManager localAssetsManager = new LocalAssetsManager(context, YourLocalDrmStorage);
```
In first constructor we implicitly implement the [LocalDrmStorage](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/LocalDrmStorage.java) interface in DefaultLocalDrmStorage class (that is actually an inner class of the LocalAssetsManager). While in second you can have your own implementation of this interface. More about LocalDrmStorage you will find later in this section. For now, lets use the default constructor.
Here we will actually register the asset to the LocalAssetsManager. Note, you have to be ***Online*** while doing so.

```
//This listener will notify you about success/fail of the registration process.
LocalAssetsManager.AssetRegistrationListener registrationListener = new LocalAssetsManager.AssetRegistrationListener() {
                    @Override
                    public void onRegistered(String assetPath) {
                        Log.i("TAG", "asset registered " + assetPath);
                    }

                    @Override
                    public void onFailed(String assetPath, Exception error) {
                        Log.e("TAG", "asset onFailed " + assetPath + " ex " + error.getMessage());
                    }
                });

//Actually register asset.
localAssetsManager.registerAsset(mediaSource, yourAssetAbsolutePath, yourAssetID, registrationListener);

```
As you see, we have to pass 4 parameters to the registration method:

- mediaSource - the [PKMediaSource]() object.
- localAssetPath - the absolute local path, where the asset is stored.
- assetId - the assetId.
- LocalAssetsManager.AssetRegistrationListener - listener, that notify you about success/fail of the registration.

Thats it! If the result was ok, you can feel yourself comfortable to play your media in offline. In order to do so, just create new instance of LocalAssetsManager(or reuse the existing one), and ask him for media source, passing the localAssetPath of the desired media and the assetId. LocalAssetsManager will give you back the PKMediaSource that will be able to play without network connection.

```
LocalAssetsManager localAssetsManager = new LocalAssetsManager(context);
PKMediaSource mediaSource = localAssetsManager.getLocalMediaSource(assetId, localAssetPath);
 
```

Now, just set the mediaSource to your PKMediaEntry and pass the PlayerConfig to the player.preapre(PlayerConfig config) method.

##Additional functionality.
LocalAssetsManager provide you with some additional functionality.
For example you can unregister the asset and check asset status. If fore some reason you decided to unregister the asset you can do it by:

```
//This listener will notify you about success when the asset was unregistered.
LocalAssetsManager.AssetRemovalListener removalListener = new LocalAssetsManager.AssetAssetRemovalListener() {
                    @Override
                    public void onRemoved(String assetPath) {
                        Log.i("TAG", "asset removed " + assetPath);
                    }
         		 });

//Actually unregister asset.
localAssetsManager.unregisterAsset(yourAssetLocalPath, yourAssetID, removalListener);

```

In case you want to check the asset drm status, you can do it so:

```
//This listener will notify you about expiration/availability time of the drm license.
LocalAssetsManager.AssetStatusListener assetStatusListener = new LocalAssetsManager.AssetStatusListener() {
                    @Override
                    public void onStatus(String localAssetPath, long expiryTimeSeconds, long availableTimeSeconds) {
                        Log.i("TAG", "asset status for " + assetPath + ": expirity time in seconds " + expiryTimeSeconds + " available time in seconds " + availableTimeSeconds);
                    }
         		 });

//Actually check the asset status.
localAssetsManager.checkAssetStatus(yourAssetLocalPath, yourAssetID, assetStatusListener);
```

##LocalDrmStorage
LocalDrmStorage is interface that have 3 methods.

- void save(String key, byte[] value);
- byte[] load(String key) throws FileNotFoundException;
- void remove(String key);

We have a defualt implementation of it, that uses Android SharedPreferences in order to save/load/remove the data. This implementation is responsible for storing the drm keySetId in order to play drm videos in offline. If your content have no drm protection, you can feel free to use this one. But in most cases you will like to implement your own way to store this data. In order to so, you need to implement LocalDrmStorage and be shure, that you are actually save/load/remove data that you receive.

