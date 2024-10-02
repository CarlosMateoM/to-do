import { createStore, createLogger } from "vuex";

import auth from "./modules/auth";
import note from "./modules/note";
import image from "./modules/image"
import category from "./modules/category";
import noteCategory from "./modules/noteCategory";

const debug = import.meta.env.MODE !== "production";

export default createStore({
    modules: {
        auth,
        note,
        image,
        category,
        noteCategory
    },
    strict: debug,
    plugins: debug ? [createLogger()] : [],
});