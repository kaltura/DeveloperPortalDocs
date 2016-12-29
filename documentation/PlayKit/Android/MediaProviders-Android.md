##Media Providers


## Create the PKMediaEntry for the OvpMediaProvider

###TBD 

## Creating PKMediaEntry for OTT PhoenixMediaProvider 
### Creat SessionProvider

```
 SessionProvider sessionProvider = new SessionProvider() {
            @Override
            public String baseUrl() {
                return baseUrl;
            }

            @Override
            public void getKs(OnCompletion<String> completion) {
                String ks = getKs();
                completion.onComplete(ks);
            }

            @Override
            public int partnerId() {
                return partnerId();
            }
        };
```

### Create PhoenixMediaProvider

```
  String assetId         = getAssetId();
  String referenceType   = getReferenceType();
  List<String> format    = new ArrayList<>(getFormats());
  String[] formatVarargs = format.toArray(new String[format.size()]); 

  MediaEntryProvider phoenixMediaProvider = new PhoenixMediaProvider().setSessionProvider(sessionProvider).setAssetId(assetId).setReferenceType(referenceType).setFormats(formatVarargs);

  loadMediaProvider(phoenixMediaProvider, converterPlayerConfig, onPlayerReadyListener, context);

```

### Load the Media Provider

In this stage you will get `PKMediaEntry` in the `ResultElement` and you will be able to pass it to the player

```
   private static void loadMediaProvider(MediaEntryProvider mediaEntryProvider, final ConverterPlayerConfig layerConfig,
                                         final Activity context) {
    mediaEntryProvider.load(new OnMediaLoadCompletion() {
			@Override
            public void onComplete(final ResultElement<PKMediaEntry> mediaEntry) {
                context.runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        if (mediaEntry.isSuccess()) {
                            #Initialize the player
                            onMediaLoaded(mediaEntry.getResponse(), playerConfig, context);
                        } else {
                            String error = "failed to fetch media data: " + (response.getError() != null ? response.getError().getMessage() : "");
                        }
                    }
                });
            }
        });
    }
```

### On Media Loaded

```
Build the Config and prepare teh player - see below...
```

## Creating PKMediaEntry for OTT tvpapi 

###Create the Media Source 

```
List<PKMediaSource> mediaSourceList = new ArrayList<>();
PKMediaSource pkMediaSource = new PKMediaSource();
pkMediaSource.setId(<FileId>);
pkMediaSource.setUrl(<Media URL>);
```
### In case of Widevine Media - DRM License is required

```
List<PKDrmParams> pkDrmDataList = new ArrayList<>();
PKDrmParams pkDrmParams = new PKDrmParams(licenseUrl);
pkDrmDataList.add(pkDrmParams);
pkMediaSource.setDrmData(pkDrmDataList);
```

###Create the Media Entry

```
PKMediaEntry mediaEntry = new PKMediaEntry();
mediaEntry.setId(<MediaId>)
mediaSourceList.add(pkMediaSource);
mediaEntry.setSources(mediaSourceList);
```



##Create MediaEntry from MockMediaProvider

### Create JsonObject with your Media Information

```
  JsonObject mediaEntryJson = new JsonObject();
  JsonObject mediaParamsJson = new JsonObject();
  JsonArray sourcesArray = new JsonArray();
  JsonObject sourcesObject = new JsonObject();
    sourcesObject.addProperty("mimeType", getMimeType());
  sourcesObject.addProperty("url", getSourceUrl());
  sourcesArray.add(sourcesObject);
  mediaParamsJson.add("sources",  sourcesArray);
  mediaEntryJson.add(<Entry_Key>, mediaParamsJson);

```
###Example:

####Clear Content
```
{
  "<Entry_Key>": {
    "sources": [
      {
        "mimeType": "application/x-mpegURL",
        "url": "myVideURL.m3u8"
      }
    ]
  }
}
```

#### Protecrted Content

```
{
  "<Entry_Key>": {
    "sources": [
      {
        "mimeType": "application/x-mpegURL",
        "url": "myVideURL.m3u8"
        "drmData": {
          "licenseUri": "<LicenseURL>"
        }
      }
    ]
  }
}


```
MimeTypes

```
    mp4_clear("video/mp4", ".mp4"),
    dash_clear("application/dash+xml", ".mpd"),
    dash_widevine("dash", "application/dash+xml", ".mpd"),
    wvm_widevine("video/wvm", ".wvm"),
    hls_clear("application/x-mpegURL", ".m3u8"),
    hls_fairplay("application/vnd.apple.mpegurl", ".m3u8");
```

###Set The MockMediaProvider:


```
MediaEntryProvider mockMediaProvider = new MockMediaProvider(mediaEntryJson, <Entry_Key>);
```

### Load the Media Provider

In this stage you will get `PKMediaEntry` in the `ResultElement` and you will be able to pass it to the player

```
   private static void loadMediaProvider(MediaEntryProvider mediaEntryProvider, final ConverterPlayerConfig playerConfig,
                                         final Activity context) {
    mediaEntryProvider.load(new OnMediaLoadCompletion() {
			@Override
            public void onComplete(final ResultElement<PKMediaEntry> mediaEntry) {
                context.runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        if (mediaEntry.isSuccess()) {
                            #Initialize the player
                            onMediaLoaded(mediaEntry.getResponse(), playerConfig, context);
                        } else {
                            String error = "failed to fetch media data: " + (response.getError() != null ? response.getError().getMessage() : "");
                        }
                    }
                });
            }
        });
    }
```
