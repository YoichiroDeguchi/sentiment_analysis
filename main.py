import json
import requests

# chatwork API
url = "https://api.chatwork.com/v2/rooms//messages?force=1"

headers = {
    "accept": "application/json",

}

response = requests.get(url, headers=headers)
response_json = response.json()

print(response_json)

# 感情分析API
key =
url = f'https://language.googleapis.com/v1/documents:analyzeSentiment?key={key}'


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


text = '今日は雨が降って楽しみにしていた外食が中止になって悲しいです。でも明日は晴れるみたいなので嬉しいです。'


result_analysis = analysis(text)
print(result_analysis['documentSentiment'])
print(result_analysis['documentSentiment']['magnitude'])
