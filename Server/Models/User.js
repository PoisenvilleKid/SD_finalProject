import mongoose from 'mongoose';

const Schema = mongoose.Schema;

const userSchema = new Schema({
    username: {
        type:String, required: true, unique: true
    },
    password: {
        type:String, required: true,
    },
    address1: {
        type:String, required: true
    },
    address2: {
        type:String
    },
    city: {
        type:String, required: true
    },
    state: {
        type:String, required: true
    },
    zip: {
        type:Number, required: true
    },
    createdAt: {
        type: Date,
        default: Date.now()
      }
});

userSchema.methods.toAuth = function(){
    return {
        username: this.username,
        password: this.password
    };
}
    

let User = mongoose.model('User',userSchema);

export default User;