# sentiment_analysis

## DEMO

  - なし

## 紹介と使い方

  - チャットワークのメッセージからその人の感情分析を行うプロダクト。

## 工夫した点

  - Pythonで分析した感情スコアをPHPに渡し、javascriptでグラフ表示させた点。
  - 定期的に実行させたかったので、sleep関数で24時間ごとに処理実行させた点。

## 苦戦した点

  - Pythonの基礎学習
  - Python（チャットワークAPI → 感情分析API） → PHP → javascriptの値渡し
  - 【実装できなかったこと】①グラフのx軸をデータが増えるごとに右に自動で伸びていくようにしたかった、②botのようにして、その日の感情スコアが0点を下回った場合チャットワーク上にメッセージ自動投稿されるようにしたかった

## 参考にした web サイトなど

  - Cloud Natural Language API https://cloud.google.com/natural-language?hl=ja
  - PHPで処理を定期的に実行 https://magazine.techacademy.jp/magazine/43044
  - phpからpythonを呼び出し実行結果を利用 https://zenn.dev/mina_moto/articles/qiita-20180923-f90ceb2f88994639ca95
  - 【python】多次元配列の作り方・参照方法 https://programming.egmoth.com/python/312