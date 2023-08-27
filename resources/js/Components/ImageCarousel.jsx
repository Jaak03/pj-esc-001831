import { Carousel } from 'antd';
import React from 'react';

const contentStyle = {
    height: '160px',
    color: '#fff',
    lineHeight: '160px',
    textAlign: 'center',
    background: '#364d79',
};

export default function ImageCarousel({ images, className = '', ...props }) {
    return images ? (
        <Carousel className="flex flex-row align-middle lg:max-w-lg md:max-w-md max-w-sm mx-6" {...props} autoplay>
            {
                images.map((image, index) => (
                    <img key={index} src={image} alt={'image'}/>
                ))
            }
        </Carousel>
    ) : null;
}
