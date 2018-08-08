import numpy as np
from PIL import Image

class ImageMorphological():
    def __init__(self, threshold = 120, image_path = './image/test.jpg'):
        self.image = np.asarray(Image.open(image_path))
        self.wb = self.gray2wb(threshold=threshold)

    def gray2wb(self, threshold=120):
        wb = (self.image >= threshold) * 255
        wb = wb.astype(np.uint8)
        return wb    

    def imsave(self, imarray, path='./image/wb.png'):
        tmp = Image.fromarray(np.uint8(imarray))
        tmp.save(path,'png')    

    def pad(self, img, row=1, col=1, mode = 'constant'):
        return np.pad(img, ((row, row), (col, col)), mode)

    def is_cover(self, kernel, img_slice):
        for i, row in enumerate(kernel):
            for j, value in enumerate(row):
                if value == 255 and img_slice[i,j] == 255:
                    continue
                if value == 255 and img_slice[i,j] == 0:
                    return False
        return True

    def erosion_bin(self, img, kernel, is_save = True, save_path = './image/erosion.png'):            
        w, h = kernel.shape
        img_pad = self.pad(img, (w-1)//2, (h-1)//2)
        tmp = np.zeros(img.shape)
        for r, row in enumerate(img):
            for c, value in enumerate(row):
                covered = self.is_cover(kernel, img_pad[r:r+w, c:c+h])
                if covered:
                    tmp[r, c] = 255
                else:
                    tmp[r, c] = 0
        if is_save:
            self.imsave(tmp, save_path)
        else:
            return tmp    

    def is_interset(self, kernel, img_slice):
        for i, row in enumerate(kernel):
            for j,value in enumerate(row):
                if value == 255 and img_slice[i, j] == 255:
                    return True
                if value == 255 and img_slice[i, j]== 0:
                    continue
        return False

    def dilation_bin(self, img, kernel, is_save = True, save_path = './image/dilation.png'):
        w, h = kernel.shape
        img_pad = self.pad(img,(w-1)//2, (h-1)//2)
        tmp = np.zeros(img.shape)
        for r, row in enumerate(img):
            for c, value in enumerate(row):
                intersected = self.is_interset(kernel, img_pad[r:r+w, c:c+h])
                if intersected:
                    tmp[r, c] = 255
                else:
                    tmp[r, c] = 0
        if is_save:
            self.imsave(tmp, save_path)
        else:
            return tmp

    def imopen(self, img, se_erosion, se_dilation, save_path='./image/open.png', mode = "bin"):
        tmp = np.zeros(img.shape)
        if mode == "bin":
            tmp = self.erosion_bin(img, se_erosion, False)
            tmp = self.dilation_bin(tmp, se_dilation, False)
        elif mode == 'gray':
            tmp = self.erosion_gray(img, se_erosion, False)
            tmp = self.dilation_gray(tmp, se_dilation, False)
        self.imsave(tmp, save_path)

    def imclose(self, img, se_erosion, se_dilation, save_path='./image/close.png', mode = "bin"):
        tmp = np.zeros(img.shape)
        if mode == 'bin':
            tmp = self.dilation_bin(img, se_dilation, False)
            tmp = self.erosion_bin(tmp, se_erosion, False)
        elif mode =="gray":
            tmp = self.dilation_gray(img, se_dilation, False)
            tmp = self.erosion_gray(tmp, se_erosion, False)
        self.imsave(tmp, save_path)

    def local_min(self, mask, img_slice):
        index = np.sum(mask).astype(np.int64)
        tmp = img_slice * mask
        return np.sort(tmp.reshape((1,-1)))[0][-index]

    def erosion_gray(self, img, kernel, is_save = True, save_path = './image/erosion_gray.png'):
        w, h = kernel.shape
        img_pad = self.pad(img, (w-1)//2, (h-1)//2, mode = 'edge') 
        tmp = np.zeros(img.shape)

        for r, row in enumerate(img):
            for c, value in enumerate(row):
                tmp[r,c] = self.local_min(kernel, img_pad[r:r+w, c:c+h])

        if is_save:
            self.imsave(tmp, save_path)
        else:
            return tmp

    def local_max(self, mask, img_slice):
        tmp = img_slice * mask
        return np.max(tmp)

    def dilation_gray(self, img, kernel, is_save = True, save_path='./image/dilation_gray.png'):    
        w, h = kernel.shape
        img_pad = self.pad(img, (w-1)//2, (h-1)//2, mode='edge')
        tmp = np.zeros(img.shape)
        
        for r, row in enumerate(img):
            for c,value in enumerate(row):
                tmp[r, c] = self.local_max(kernel, img_pad[r:r+w,c:c+h])
        if is_save:
            self.imsave(tmp, save_path)
        else:
            return tmp


if __name__ == '__main__':
    img = ImageMorphological(threshold=120, image_path = './image/test.jpg')
    image = img.image
    img.imsave(img.wb,'./image/wb.png')

    kernel1 = np.array([[0,255,0],[255,255,255],[0,255,0]])
    kernel2 = np.ones((3,3))*255
    kernel3 = np.array([[0,0,255,0,0], [0,255,255,255,0], [255,255,255,255,255],[0,255,255,255,0], [0,0,255,0,0]])
    kernel4 = np.ones((5,5))*255

    img.erosion_bin(img.wb, kernel1, save_path='./image/erosion_bin_k1.png')
    img.erosion_bin(img.wb, kernel2, save_path='./image/erosion_bin_k2.png')
    img.erosion_bin(img.wb, kernel3, save_path='./image/erosion_bin_k3.png')
    img.erosion_bin(img.wb, kernel4, save_path='./image/erosion_bin_k4.png')


    img.dilation_bin(img.wb, kernel1, save_path='./image/dilation_bin_k1.png')
    img.dilation_bin(img.wb, kernel2, save_path='./image/dilation_bin_k2.png')
    img.dilation_bin(img.wb, kernel3, save_path='./image/dilation_bin_k3.png')
    img.dilation_bin(img.wb, kernel4, save_path='./image/dilation_bin_k4.png')

    img.imopen(img.wb, kernel1, kernel1, save_path='./image/open_binary_k11.png')
    img.imopen(img.wb, kernel2, kernel2, save_path='./image/open_binary_k22.png')
    img.imopen(img.wb, kernel3, kernel3, save_path='./image/open_binary_k33.png')
    img.imopen(img.wb, kernel4, kernel4, save_path='./image/open_binary_k44.png')

    img.imclose(img.wb, kernel1, kernel1, save_path='./image/close_binary_k11.png')
    img.imclose(img.wb, kernel2, kernel2, save_path='./image/close_binary_k22.png')
    img.imclose(img.wb, kernel3, kernel3, save_path='./image/close_binary_k33.png')
    img.imclose(img.wb, kernel4, kernel4, save_path='./image/close_binary_k44.png')

    mask1 = np.array([[0,1,0],[1,1,1],[0,1,0]])
    mask2 = np.ones((3,3))
    mask3 = np.array([[0,0,1,0,0],[0,1,1,1,0],[1,1,1,1,1],[0,1,1,1,0],[0,0,1,0,0]])
    mask4 = np.ones((5,5))


    img.erosion_gray(img.image, mask1, save_path='./image/erosion_gray_k1.png')
    img.erosion_gray(img.image, mask2, save_path='./image/erosion_gray_k2.png')
    img.erosion_gray(img.image, mask3, save_path='./image/erosion_gray_k3.png')
    img.erosion_gray(img.image, mask4, save_path='./image/erosion_gray_k4.png')

    img.dilation_gray(img.image, mask1, save_path='./image/dilation_gray_k1.png')
    img.dilation_gray(img.image, mask2, save_path='./image/dilation_gray_k2.png')
    img.dilation_gray(img.image, mask3, save_path='./image/dilation_gray_k3.png')
    img.dilation_gray(img.image, mask4, save_path='./image/dilation_gray_k4.png')

    #gray kernels open
    img.imopen(img.image, mask1, mask1, save_path='./image/open_gray_k11.png', mode='gray')
    img.imopen(img.image, mask2, mask2, save_path='./image/open_gray_k22.png', mode='gray')
    img.imopen(img.image, mask3, mask3, save_path='./image/open_gray_k33.png', mode='gray')
    img.imopen(img.image, mask4, mask4, save_path='./image/open_gray_k44.png', mode='gray')

    #gray kernels close
    img.imclose(img.image, mask1, mask1, save_path='./image/close_gray_k11.png', mode='gray')
    img.imclose(img.image, mask2, mask2, save_path='./image/close_gray_k22.png', mode='gray')
    img.imclose(img.image, mask3, mask3, save_path='./image/close_gray_k33.png', mode='gray')
    img.imclose(img.image, mask4, mask4, save_path='./image/close_gray_k44.png', mode='gray')
    