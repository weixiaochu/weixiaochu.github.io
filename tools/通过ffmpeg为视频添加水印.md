# 通过ffmpeg为视频添加水印

```shell
# 左上角
ffmpeg -i 1.mp4 -i 1.png -filter_complex 'overlay=main_w-overlay_w-10:main_h-overlay_h-10' output.mp4
# 左上角
ffmpeg -i 1.mp4 -vf  "movie=1.png,scale=300:95[watermask]; [in] [watermask] overlay=300:95 [out]" outfile.mp4
# 右下脚
ffmpeg -i 1.mp4 -vf "movie=1.png[watermark];[in][watermark] overlay=main_w-overlay_w-10:main_h-overlay_h-10[out] " output.mp4
# 右上脚
ffmpeg -i 1.mp4 -vf "movie=1.png[logo];[in][logo]overlay=main_w-overlay_w-10:10[out]" output.mp4
```

