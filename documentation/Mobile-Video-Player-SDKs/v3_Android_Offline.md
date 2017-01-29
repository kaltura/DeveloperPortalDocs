---
layout: page
---

## Offline Playback

This article describes how to implement offline playback in Playkit SDK on Android devices. 

First, download the media you wish to play. If you are looking for a good download manager you can use [this](https://github.com/kaltura/playkit-dtg-android) one. In general the most complex part of the playback in offline is managing the DRM content license, but we've already covered that issue for you.

## Registering the Asset  

First, you'll need to create an instance of the [LocalAssetManager](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/LocalAssetsManager.java).

Note that you have two constructors for this object; however, the first constructor only receives Android context.

>**Important!** The context must be the Android Application context.

```java
  //Create new instance of localAssetManager with default implementatoin of LocalDrmStorage.
  LocalAssetsManager localAssetsManager = new LocalAssetsManager(context);
```

Next, accept an additional parameter of type [LocalDrmStorage](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/LocalDrmStorage.java).

```java
  //Create new instance of localAssetManager with custom implementatoin of LocalDrmStorage.
  LocalAssetsManager localAssetsManager = new LocalAssetsManager(context, YourLocalDrmStorage);
```

In first constructor, we implicitly implemented the [LocalDrmStorage](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/LocalDrmStorage.java) interface in the DefaultLocalDrmStorage class (which is actually an inner class of the LocalAssetsManager). In the second constructor, you can have your own implementation of this interface. You can read more about the LocalDrmStorage later in this section. For now, let's use the default constructor.

Register the asset to the LocalAssetsManager. Note that you'll need to be ***Online*** while doing so.

```java
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
As you can see, you'll have to pass four parameters to the registration method:

- mediaSource - the [PKMediaSource]() object.
- localAssetPath - the absolute local path, where the asset is stored.
- assetId - the assetId.
- LocalAssetsManager.AssetRegistrationListener - the listener that notifies about the success/failure of the registration.

If the result is successful, you're ready to play your media in offline; to do so, simply create a new instance of the LocalAssetsManager(or reuse the existing one), and ask it for the media source, and then pass the localAssetPath of the desired media and the assetId. The LocalAssetsManager will return the PKMediaSource, which can play the media without a network connection.

```java
  LocalAssetsManager localAssetsManager = new LocalAssetsManager(context);
  PKMediaSource mediaSource = localAssetsManager.getLocalMediaSource(assetId, localAssetPath);
 
```

Next, set the mediaSource to your PKMediaEntry and pass the PlayerConfig to the player.preapre(PlayerConfig config) method.

## Additional Functionality  

The LocalAssetsManager can provide you with some additional functionality. For example you can unregister the asset and check the asset status. 

### Unregistering an Asset  

To unregister the asset:

```java
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
### Checking the Asset's DRM Status  

To check the asset's DRM:

```java
  //This listener will notify you about expiration/availability time of the drm license.
  LocalAssetsManager.AssetStatusListener assetStatusListener = new LocalAssetsManager.AssetStatusListener() {
                    @Override
                    public void onStatus(String localAssetPath, long expiryTimeSeconds, long availableTimeSeconds) {
                        Log.i("TAG", "asset status for " + assetPath + ": expirity time in seconds " + expiryTimeSeconds + " available  time in seconds " + availableTimeSeconds);
                    }
         		 });

  //Actually check the asset status.
  localAssetsManager.checkAssetStatus(yourAssetLocalPath, yourAssetID, assetStatusListener);
```

## LocalDrmStorage  

The LocalDrmStorage is an interface that has three methods:

- void save(String key, byte[] value);
- byte[] load(String key) throws FileNotFoundException;
- void remove(String key);

Kaltura uses a default implementation of the LocalDrmStorage that uses Android SharedPreferences to save/load/remove the data. This implementation is responsible for storing the DRM keySetId to play DRM videos in offline. If your content doesn't have DRM protection, you can use this implementation freely. Howevever, you'll likely want to implement your own way of storing this data. To do so, you'll need to implement LocalDrmStorage and verify that you are actually saving/loading/removing the data that you receive.

</br>

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.

