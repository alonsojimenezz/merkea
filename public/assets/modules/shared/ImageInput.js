class ImageInput {

    constructor() {}

    instance(id) {
        const imageInputElement = document.querySelector("#" + id);
        return KTImageInput.getInstance(imageInputElement);

    }
}

export default ImageInput;