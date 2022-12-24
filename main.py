import json
import requests

# chatwork API
url = ""

headers = {
    "accept": "application/json",
    "x-chatworktoken": ""
}

response = requests.get(url, headers=headers)
response_json = response.json()  # jsonへ変換
# for list2D in response_json:  # 3次元配列から2次元配列を取り出す
#     account_data = list2D["account"]["account_id"] #accountの中のaccount_idを参照
#     print(account_data)
# for list1D in list2D:
#     print(list1D)

# 指定アカウントのメッセージを取り出し
message_arry = []
response_account_data = list(
    filter(lambda item: item["account"]["account_id"] == 4011838, response_json))
for list2D in response_account_data:  # 2次元配列にする
    account_message = list2D["body"]  # メッセージのみ取り出し
    message_arry.append(account_message)  # 空の配列へ放り込む

message_str = str(message_arry)  # オブジェクト → 文字列へ変換
text = message_str  # textへ入れて感情分析APIに渡す

# 感情分析API
key = ''
url = f''


def analysis(text):
    header = {'Content-Type': 'application/json'}
    body = {
        "document": {
            "type": "PLAIN_TEXT",
            "language": "JA",
            "content": text
        }
    }
    res = requests.post(url, headers=header, json=body)
    result = res.json()
    return result


result_analysis = analysis(text)
# print(result_analysis)
# print(result_analysis['documentSentiment'])
# print(result_analysis['documentSentiment']['magnitude'])  # 感情の強度
print(result_analysis['documentSentiment']['score'])  # 感情スコア
