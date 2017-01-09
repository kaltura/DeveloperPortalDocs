---
layout: page
title: Setting Up Session Providers for Android Devices
subcat: Android Version 3.0
weight: 398
---

The SessionProvider interface defines the base requirements for implementing an element that enables access to a remote data source by the player's components.

Components such as Media Providers and some of the OVP plugins that need to connect to the remote data source and request actions, get data, and update date, work with the SessionProvider.

The SessoinProvider provides the following:

1. A Base url - This is the domain name of the designated remote host.
  _**The Base url should only contain the host domain name and should not include
   a path to the services within.**_

 _Example:_
  ```
  OVP base url: https://cdnapisec.kaltura.com/
  ```
2. A Session Token - This is a valid session key to work against the data source.
3. PartnerId - The partner that was used to create the session token.

>Note: You can create your own SessionProvider implementation or use the provided SDK implementations.


## Creating a SessionProvider  

There are a number of options for creating a SessionProvider:

### Self Implemented

You can create a SessionProvider using an anonymous interface instantiation or implementing a class.


     ```
     SessionProvider sessionProvider = new SessionProvider() {
            @Override
            public String baseUrl() {
                return baseUrl;
            }

            @Override
            public void getKs(OnCompletion<PrimitiveResult> completion) {
                completion.onComplete(new PrimitiveResult(getKs()));
            }

            @Override
            public int partnerId() {
                return partnerId();
            }
        };
      ```

### Provided Implementation

You can create a SessionProvider using the existing OttSessionProvider or OvpSessionProvider providerrs.

#### OttSessionProvider  

The [OttSessionProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/phoenix/OttSessionProvider.java) supports anonymous and user-specific session creation, on the Kaltura Phoenix Backend.

* The Anonymous session starts with the "ottUser/anonymousLogin" API.
* User specific session starts with the "ottUser/login" API, according to the username and password.

The provider handles the refreshes of the session token when needed, before the token expires, and renews the session if it expires.
Upon every session token fetching request, the session provider checks the current token validity; if the token has expired and can be renewed, the provider renews the token.

A user session can be ended by making the session token invalid. This  means that additional requests using that token will fail.
Once a session has ended it can't be renewed, and a new session should be started.

To end a session, use the "ottUser/logout" API.

An anonymous session can't be ended Until the session token (KS) expires.

After a session has started, the SessionProvider is ready and can be used as a parameter for media providers and other components.

**Using the OttSessionProvider**

To use the OttSessionProvider, implement the following:

    ```
    OttSessionProvider ottSessionProvider = new OttSessionProvider(PhoenixBaseUrl, partnerId);
    ottSessionProvider.startSession(username, password, udid, new OnComplition<PrimitiveRersult>(){
     @Override
        public void onComplete(PrimitiveResult response) {
            if(response.isSuccess()) { // has valid session:

                phoenixMediaProvider = new PhoenixMediaProvider()
                              .setSessionProvider(ottSessionProvider)
                              .setReferenceType(APIDefines.AssetReferenceType.Media)
                              .setAssetId(ChannelId)
                              .setFormats(FormatHD, FormatSD);

                phoenixMediaProvider.load(new OnMediaLoadCompletion() {
                    @Override
                    public void onComplete(ResultElement<PKMediaEntry> response) {
                      ...
                    }
                });

            } else { // error: session creation failed
              ErrorElement error = response.getError();
            }
        }
    });

    ```
#### OvpSessionProvider  

The [OvpSessionProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/ovp/OvpSessionProvider.java) supports anonymous and user-specific session creation on Kaltura's OVP Backend.

* A anonymous session starts with the "session/startWidgetSession" API.
* A user specific session starts with the "user/loginByLoginId" API

By default a session is valid for 24 hours. Once expired, the OvpSessionProvider will try to renew the session.

A user session can be ended by making the session token invalid. This  means that additional requests using that token will fail.
Once a session has ended it can't be renewed, and a new session should be started.

To end a session, use the "session/end" API.

> Note: An anonymous session can't be ended. Until the session token (KS) expires the token can be used.

After a session starts, the SessionProvider is ready and can be used as a parameter for media providers and other components.


**Using the OvpSessionProvider**

To use the OvpSessionProvider, implement the following:

      ```
      OvpSessionProvider ovpSessionProvider = new OvpSessionProvider(OvpBaseUrl);
      ovpSessionProvider.startAnonymousSession(partnerId, new OnComplition<PrimitiveRersult>(){
       @Override
          public void onComplete(PrimitiveResult response) {
              if(response.isSuccess()) { // has valid session:

                  kalturaOvpMediaProvider = new KalturaOvpMediaProvider()
                                .setSessionProvider(ovpSessionProvider)
                                .setEntryId(EntryId);

                  kalturaOvpMediaProvider.load(new OnMediaLoadCompletion() {
                      @Override
                      public void onComplete(ResultElement<PKMediaEntry> response) {
                        ...
                      }
                  });

              } else { // error: session creation failed
                ErrorElement error = response.getError();
              }
          }
      });

      ```
