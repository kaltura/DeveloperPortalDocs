---
layout: page
title: Known issues and limitations
subcat: Android
weight: 291
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

##Black screen blinking using player in fragment.

There is a well known issue using android [SurfaceView](https://developer.android.com/reference/android/view/SurfaceView.html) inside Fragment. You can see this in stackoverflow [here](http://stackoverflow.com/questions/8772862/surfaceview-flashes-black-on-load/12636285#12636285). When the surface view appears in the window the very fist time, it requests the window's parameters changing by calling a private IWindowSession.relayout(..) method. This method "gives" you a new frame, window, and window surface. That are actually empty on this stage. 

Our solution is pretty simple. All you need to do is just to add this line of code in the root Activity, that is actually responsible for creating the Player Fragment:

```
 @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        getWindow().setFormat(PixelFormat.TRANSLUCENT);
        setFragments();
    }
```

By calling the 

```
getWindow().setFormat(PixelFormat.TRANSLUCENT);
```

Immidiatly after the super.onCreate(savedInstanceState); But before the 

```
setContentView();
```

This will make surfaceView transcluent until the layout is actually created.