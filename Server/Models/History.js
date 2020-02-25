//$UserName,$Gallons,$Address1,$Date,$SuggestedPrice,$Total

import mongoose from 'mongoose';

const Schema = mongoose.Schema;

const historySchema = new Schema({
    username: {
        type:String, required: true, unique: true
    },
    gallons: {
        type:Number, required: true,
    },
    address1: {
        type:String, required: true
    },
    date: {
        type:Date, required: true
    },
    suggestedPrice: {
        type:number, required: true
    },
    total: {
        type:number, required: true
    }
});

let History = mongoose.model('history', historySchema);

export default History;