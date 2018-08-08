import requests, os
from lxml import etree

class spiderPipeline(object):
    def process_time(self, item, spider):
        book_url = item['book_url']
        book_chapter_url = item['book_chapter_url']
        book_chapter_name = item['book_chapter_name']

        for each_url, chapter in zip(book_chapter_url,book_chapter_name):
            load_url = book_url + each_url
            chapter_name = chapter
            res1 = requests.get(load_url).text
            html1 = etree.HTML(res1)
            text = html1.xpath('//div[@id = "htmlContent"]/text()')

            path = '/novel/'+item['book_name']
            if not os.path.exists(path):
                os.makedirs(path)
            for each in text:
                content = each.replace('\xa0\xa0\xa0\xa0','')
                file = open(path + "/" + chapter_name + ".txt", "a")
                file.write(content)
                file.close()
        return item            