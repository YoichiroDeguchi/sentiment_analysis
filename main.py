import requests
key = 'AIzaSyCYBHtlOowgv2OsXIJHiRnLvLhMmEa8vnA'
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


text = '今日は雨が降って楽しみにしていた外食が中止になって悲しいです。'

json = analysis(text)
print(json['documentSentiment'])
print(json['documentSentiment']['magnitude'])


# chatwork API
url = "https://api.chatwork.com/v2/rooms/156657493/messages?force=1"

headers = {
    "accept": "application/json",
    "x-chatworktoken": "6015f0e82771fb9cb4f1e9f5d6fd7913"
}

response = requests.get(url, headers=headers)

print(response.text)
