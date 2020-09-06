import PIL.Image
import numpy
import requests
import time
from io import BytesIO
import json

res_image = requests.get('https://mimgnews.pstatic.net/image/079/2019/10/15/0003280179_001_20191015070106518.jpg')
image = img = PIL.Image.open(BytesIO(res_image.content))
image_np = numpy.array(image)


payload = {"instances": [image_np.tolist()]}
res = requests.post("http://163.239.76.94:8080/v1/models/default:predict", json=payload)

result = json.loads(res.content.decode('utf-8'))

scores = result['predictions'][0]['detection_scores']
boxes = result['predictions'][0]['detection_boxes']

label = ["person", "bicycle", "car", "motorcycle", "airplane", "bus", "train", "truck", "boat", "traffic light", "fire hydrant", "stop sign", "parking meter", "bench", "bird", "cat", "dog", "horse", "sheep", "cow", "elephant", "bear", "zebra", "giraffe", "backpack", "umbrella", "handbag", "tie", "suitcase", "frisbee", "skis", "snowboard", "sports ball", "kite", "baseball bat", "baseball glove", "skateboard", "surfboard", "tennis racket", "bottle", "wine glass", "cup", "fork", "knife", "spoon", "bowl", "banana", "apple", "sandwich", "orange", "broccoli", "carrot", "hot dog", "pizza", "donut", "cake", "chair", "couch", "potted plant", "bed", "dining table", "toilet", "tv", "laptop", "mouse", "remote", "keyboard", "cell phone", "microwave", "oven", "toaster", "sink", "refrigerator", "book", "clock", "vase", "scissors", "teddy bear", "hair drier", "toothbrush"]
#print(label[0])
#print(scores[0])
#print(boxes[0])
for i in range(len(label)):
	if(scores[i]>0.5):
		print(label[i])
		print(scores[i])
		print(boxes[i])

