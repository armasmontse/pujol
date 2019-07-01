import './admin/gallery'
import './admin/hex-color-text-input'
import './admin/sortable-tables'
import './admin/featured-image'
import {defaultFileUploadConfig} from './admin/file-upload'
import {initializeRepiters} from './admin/repiter-fields'

defaultFileUploadConfig()

console.log();
initializeRepiters();
